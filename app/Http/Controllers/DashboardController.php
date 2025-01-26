<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleStat;
use App\Models\Earning;
use App\Models\WriterEarning;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Current month's earnings
        $currentMonth = now()->month;
        $currentMonthEarning = Earning::where('user_id', Auth::id())
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        // Last month's earnings
        $lastMonth = now()->subMonth();
        $lastMonthEarning = Earning::where('user_id', Auth::id())
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('total_amount');

        // Percentage change in earnings
        $percentageChange = 0;
        if ($lastMonthEarning > 0) {
            $percentageChange = (($currentMonthEarning - $lastMonthEarning) / $lastMonthEarning) * 100;
        }

        $articles = Article::where('user_id', Auth::id())
            ->with(['category', 'stats'])
            ->orderByDesc('created_at')
            ->get();

        $totalViews = ArticleStat::whereIn('article_id', $articles->pluck('id'))->sum('views');

        $earnings = Earning::where('user_id', Auth::id())->get();
        $totalEarnings = $earnings->sum('total_amount');

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now();
        $stats = ArticleStat::whereIn('article_id', $articles->pluck('id'))
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy('date');

        // Siapkan data untuk grafik
        $dates = [];
        $viewsData = [];
        $readsData = [];

        foreach (range(1, now()->daysInMonth) as $day) {
            $date = now()->startOfMonth()->addDays($day - 1)->format('Y-m-d');
            $dates[] = now()->startOfMonth()->addDays($day - 1)->format('M j');

            // Jika tidak ada data pada tanggal tersebut, default ke 0
            $viewsData[] = isset($stats[$date]) ? $stats[$date]->sum('views') : 0;
            $readsData[] = isset($stats[$date]) ? $stats[$date]->sum('reads') : 0;
        }

        return view('dashboard.index', compact(
            'dates',
            'viewsData',
            'readsData',
            'totalEarnings',
            'totalViews',
            'currentMonthEarning',
            'lastMonthEarning',
            'percentageChange',
            'earnings'
        ));
    }
}
