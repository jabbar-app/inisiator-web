<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Earning;
use App\Models\User;
use App\Models\WriterEarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EarningController extends Controller
{
    public function index()
    {
        // Ambil semua data earnings untuk user
        $earnings = Earning::where('user_id', Auth::id())->get();

        // Hitung total saldo dari semua earnings
        $totalEarnings = $earnings->sum('total_amount');

        // Total views dihitung dari writer_earnings
        $totalViews = WriterEarning::where('user_id', Auth::id())->sum('views_count');
        $totalArticles = Article::where('user_id', Auth::id())->where('status', 'approved')->count();

        // Threshold minimal
        $threshold = 500000;

        return view('earnings.index', compact('earnings', 'totalEarnings', 'totalViews', 'totalArticles', 'threshold'));
    }

    public function checkIn()
    {
        $user = User::find(Auth::id());
        $today = now()->format('Y-m-d');

        // Cek apakah user sudah check-in hari ini
        if ($user->check_in_date === $today) {
            return back()->with('error', 'Anda sudah check-in hari ini.');
        }

        // Hitung streak (jika user check-in berturut-turut)
        if ($user->check_in_date === now()->subDay()->format('Y-m-d')) {
            $user->check_in_streak += 1;
        } else {
            $user->check_in_streak = 1; // Reset streak jika tidak check-in berturut-turut
        }

        // Tentukan hadiah berdasarkan streak
        $reward = match ($user->check_in_streak) {
            1 => 25,
            2 => 50,
            3 => 25,
            4 => 50,
            5 => 10,
            6 => 15,
            7 => rand(15, 2500),
            default => 25,
        };

        // Tambahkan data check-in ke earnings
        $earning = Earning::create([
            'user_id' => $user->id,
            'type' => 'check-in',
            'total_amount' => $reward,
            'details' => json_encode([
                'streak' => $user->check_in_streak,
                'reward' => $reward,
                'date' => $today,
            ]),
        ]);

        // Update tanggal check-in dan streak pengguna
        $user->update([
            'check_in_date' => $today,
            'check_in_streak' => $user->check_in_streak,
        ]);

        return back()->with('success', "Anda berhasil check-in dan mendapatkan Rp{$reward}!");
    }

    public function calculate()
    {
        $userId = Auth::id();

        // Ambil data WriterEarning pengguna
        $writerEarnings = WriterEarning::where('user_id', $userId)->get();

        $totalAmount = $writerEarnings->sum('amount');
        $details = $writerEarnings->map(function ($item) {
            return [
                'period' => $item->period,
                'amount' => $item->amount,
                'views' => $item->views_count,
                'rank_rate' => $item->rank_rate,
            ];
        });

        // Simpan data earnings views ke earnings
        Earning::updateOrCreate(
            [
                'user_id' => $userId,
                'type' => 'views'
            ],
            [
                'total_amount' => $totalAmount,
                'details' => json_encode($details),
            ]
        );

        return redirect()->back()->with('success', 'Earnings recalculated successfully.');
    }
}
