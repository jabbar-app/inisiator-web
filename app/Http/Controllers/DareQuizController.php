<?php

namespace App\Http\Controllers;

use App\Models\DareQuiz;
use App\Models\DareResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DareQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = DareQuiz::all();
        return view('game.dare.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('game.dare.quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'nullable|string',
        ]);

        $location = $this->getLocationFromIP($request->ip());
        $device = $this->getDeviceDetails($request);

        // Simpan kuis ke database
        $quiz = DareQuiz::create([
            'user_id' => Auth::id(),
            'slug' => $request->input('slug'),
            'location' => $location,
            'device' => json_encode($device),
        ]);

        // Redirect ke halaman untuk menambahkan pertanyaan ke kuis ini
        return redirect()->route('dare-questions.create', ['quiz_id' => $quiz->id])
            ->with('success', 'Quiz created successfully. You can now add questions.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DareQuiz $dareQuiz)
    {
        // Ambil leaderboard berdasarkan skor tertinggi, lalu waktu terendah
        $leaderboard = DareResponse::where('dare_quiz_id', $dareQuiz->id)
            ->orderByDesc('score')
            ->orderBy('time')
            ->take(10) // Batasi leaderboard ke 10 peserta teratas
            ->get();

        return view('game.dare.quizzes.show', compact('dareQuiz', 'leaderboard'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DareQuiz $dareQuiz)
    {
        return view('game.dare.quizzes.edit', compact('dareQuiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DareQuiz $dareQuiz)
    {
        $request->validate([
            'slug' => 'nullable|url',
        ]);

        $location = $this->getLocationFromIP($request->ip());
        $device = $this->getDeviceDetails($request);

        $dareQuiz->update([
            'slug' => $request->input('slug'),
            'location' => $location,
            'device' => json_encode($device),
        ]);

        return redirect()->route('dare-quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DareQuiz $dareQuiz)
    {
        $dareQuiz->delete();
        return redirect()->route('dare-quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    /**
     * Get location from IP address.
     */
    private function getLocationFromIP($ip)
    {
        try {
            $response = Http::get("http://ip-api.com/json/$ip");
            if ($response->successful() && $response->json('status') === 'success') {
                return $response->json('city') ?: 'Unknown';
            }
        } catch (\Exception $e) {
            return 'Unknown';
        }

        return 'Unknown';
    }

    /**
     * Get device details.
     */
    private function getDeviceDetails(Request $request)
    {
        $userAgent = $request->header('User-Agent');
        $device = [
            'platform' => $this->getPlatform($userAgent),
            'browser' => $this->getBrowser($userAgent),
        ];

        return $device;
    }

    /**
     * Extract platform from User-Agent.
     */
    private function getPlatform($userAgent)
    {
        if (preg_match('/windows/i', $userAgent)) {
            return 'Windows';
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            return 'Mac';
        } elseif (preg_match('/linux/i', $userAgent)) {
            return 'Linux';
        } elseif (preg_match('/iphone/i', $userAgent)) {
            return 'iPhone';
        } elseif (preg_match('/android/i', $userAgent)) {
            return 'Android';
        }

        return 'Unknown';
    }

    /**
     * Extract browser from User-Agent.
     */
    private function getBrowser($userAgent)
    {
        if (preg_match('/firefox/i', $userAgent)) {
            return 'Firefox';
        } elseif (preg_match('/chrome|chromium/i', $userAgent)) {
            return 'Chrome';
        } elseif (preg_match('/safari/i', $userAgent)) {
            return 'Safari';
        } elseif (preg_match('/opera|opr/i', $userAgent)) {
            return 'Opera';
        } elseif (preg_match('/edge/i', $userAgent)) {
            return 'Edge';
        }

        return 'Unknown';
    }
}
