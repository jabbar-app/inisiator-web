<?php

namespace App\Http\Controllers;

use App\Models\DareQuiz;
use App\Models\DareReaction;
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
        $countryCodes = [
            62 => 'Indonesia',
            1 => 'Amerika Serikat',
            44 => 'Inggris Raya',
            91 => 'India',
            60 => 'Malaysia',
            86 => 'Tiongkok',
            81 => 'Jepang',
            49 => 'Jerman',
            33 => 'Prancis',
            39 => 'Italia',
            82 => 'Korea Selatan',
            7 => 'Rusia',
            55 => 'Brasil',
            61 => 'Australia',
            1 => 'Kanada',
            966 => 'Arab Saudi',
            27 => 'Afrika Selatan',
            92 => 'Pakistan',
            90 => 'Turki',
            34 => 'Spanyol',
            31 => 'Belanda',
            46 => 'Swedia',
            41 => 'Swiss',
            47 => 'Norwegia',
            45 => 'Denmark',
            358 => 'Finlandia',
            353 => 'Irlandia',
            351 => 'Portugal',
            352 => 'Luksemburg',
            377 => 'Monako',
            378 => 'San Marino',
            379 => 'Vatikan',
            213 => 'Aljazair',
            20 => 'Mesir',
            212 => 'Maroko',
            216 => 'Tunisia',
            234 => 'Nigeria',
            251 => 'Ethiopia',
            254 => 'Kenya',
            255 => 'Tanzania',
            263 => 'Zimbabwe',
            64 => 'Selandia Baru',
            65 => 'Singapura',
            66 => 'Thailand',
            84 => 'Vietnam',
            971 => 'Uni Emirat Arab',
            972 => 'Israel',
            974 => 'Qatar',
            965 => 'Kuwait',
            968 => 'Oman',
            973 => 'Bahrain',
            962 => 'Yordania',
            961 => 'Lebanon',
            963 => 'Suriah',
            967 => 'Yaman',
            960 => 'Maladewa',
            975 => 'Bhutan',
            977 => 'Nepal',
            994 => 'Azerbaijan',
            995 => 'Georgia',
            996 => 'Kirgistan',
            998 => 'Uzbekistan',
            299 => 'Greenland',
            298 => 'Kepulauan Faroe',
            297 => 'Aruba',
            290 => 'Saint Helena',
            268 => 'Swaziland',
            267 => 'Botswana',
            266 => 'Lesotho',
            265 => 'Malawi',
            264 => 'Namibia',
            263 => 'Zimbabwe',
            262 => 'Reunion',
            261 => 'Madagaskar',
            260 => 'Zambia',
            258 => 'Mozambik',
            257 => 'Burundi',
            256 => 'Uganda',
            255 => 'Tanzania',
            254 => 'Kenya',
            253 => 'Djibouti',
            252 => 'Somalia',
            251 => 'Ethiopia',
            250 => 'Rwanda',
            249 => 'Sudan',
            248 => 'Seychelles',
            246 => 'Diego Garcia',
            245 => 'Guinea-Bissau',
            244 => 'Angola',
            243 => 'Republik Demokratik Kongo',
            242 => 'Kongo',
            241 => 'Gabon',
            240 => 'Guinea Khatulistiwa',
            239 => 'Sao Tome dan Principe',
            238 => 'Tanjung Verde',
            237 => 'Kamerun',
            236 => 'Republik Afrika Tengah',
            235 => 'Chad',
            234 => 'Nigeria',
            233 => 'Ghana',
            232 => 'Sierra Leone',
            231 => 'Liberia',
            230 => 'Mauritius',
            229 => 'Benin',
            228 => 'Togo',
            227 => 'Niger',
            226 => 'Burkina Faso',
            225 => 'Pantai Gading',
            224 => 'Guinea',
            223 => 'Mali',
            222 => 'Mauritania',
            221 => 'Senegal',
            220 => 'Gambia',
            218 => 'Libya',
            216 => 'Tunisia',
            213 => 'Aljazair',
            212 => 'Maroko',
            211 => 'Sudan Selatan',
            20 => 'Mesir',
        ];

        return view('game.dare.quizzes.create', compact('countryCodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $location = $this->getLocationFromIP($request->ip());
        $device = $this->getDeviceDetails($request);

        // dd($request->ip());

        // Simpan kuis ke database
        $quiz = DareQuiz::create([
            'user_id' => Auth::id(),
            'slug' => $user->username,
            'location' => $location,
            'device' => json_encode($device),
        ]);

        // Redirect ke halaman untuk menambahkan pertanyaan ke kuis ini
        return redirect()->route('play.dare.add-questions', ['quiz_id' => $quiz->id])
            ->with('success', 'Quiz created successfully. You can now add questions.');
    }

    public function show(string $slug, Request $request)
    {
        $identifier = app(DareResponseController::class)->getUserIdentifier($request);
        $response = DareResponse::where('identifier', $identifier)->first();
        $quiz = DareQuiz::where('slug', $slug)->first();
        $title = $quiz->user->name."'s Quiz";

        $leaderboard = DareResponse::where('dare_quiz_id', $quiz->id)
            ->orderByDesc('score')
            ->orderBy('time')
            ->paginate(10);

        // Ambil reaksi untuk setiap jenis
        $reactions = [];
        foreach (['Like', 'Love', 'Wow', 'Angry', 'Sad'] as $reaction) {
            $reactions[$reaction] = DareReaction::where('dare_quiz_id', $quiz->id)
                ->where('content', $reaction)
                ->pluck('name')
                ->toArray();
        }

        return view('game.dare.quizzes.show', compact('quiz', 'leaderboard', 'identifier', 'response', 'reactions', 'title'));
    }

    public function updateSong(Request $request, $id)
    {
        $quiz = DareQuiz::findOrFail($id);

        // Validasi input
        $request->validate([
            'song' => 'nullable|string',
        ]);

        // Update lagu yang dipilih
        $quiz->update([
            'song' => $request->input('song'),
        ]);

        // Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Lagu berhasil diperbarui!',
        ]);
    }

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
