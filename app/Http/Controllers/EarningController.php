<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Earning;
use App\Models\WriterEarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EarningController extends Controller
{
    public function index()
    {
        $earnings = Earning::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'total_amount' => 0,
                'details' => [],
            ]
        );

        // Total views dihitung dari writer_earnings
        $totalViews = WriterEarning::where('user_id', Auth::id())->sum('views_count');
        $totalArticles = Article::where('user_id', Auth::id())->where('status', 'approved')->count();

        // Threshold minimal
        $threshold = 500000;

        return view('earnings.index', compact('earnings', 'totalViews', 'totalArticles', 'threshold'));
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

        // Perbarui atau buat data di tabel earnings
        Earning::updateOrCreate(
            ['user_id' => $userId],
            [
                'total_amount' => $totalAmount,
                'details' => $details,
            ]
        );

        return redirect()->back()->with('success', 'Earnings recalculated successfully.');
    }
}
