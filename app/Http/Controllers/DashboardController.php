<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Earning;
use App\Models\WriterEarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(EarningController $earningController)
    {
        $userEarning = Auth::user()->earning->amount ?? 0;

        // Ambil pendapatan bulan ini
        $currentMonth = now()->month;
        $currentMonthEarning = WriterEarning::where('user_id', Auth::id())
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        // Ambil pendapatan bulan lalu
        $lastMonth = now()->subMonth();
        $lastMonthEarning = WriterEarning::where('user_id', Auth::id())
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('amount');

        // Hitung persentase perubahan
        $percentageChange = 0;
        if ($lastMonthEarning > 0) {
            $percentageChange = (($currentMonthEarning - $lastMonthEarning) / $lastMonthEarning) * 100;
        }

        // Total views (optional jika diperlukan)
        $totalViews = Article::where('user_id', Auth::id())->sum('views');

        $earnings = Earning::all();

        return view('dashboard.index', compact(
            'userEarning',
            'totalViews',
            'currentMonthEarning',
            'lastMonthEarning',
            'percentageChange',
            'earnings'
        ));
    }
}
