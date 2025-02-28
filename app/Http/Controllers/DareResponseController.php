<?php

namespace App\Http\Controllers;

use App\Models\DareAnswer;
use App\Models\DareQuestion;
use App\Models\DareQuiz;
use App\Models\DareResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DareResponseController extends Controller
{
    public function setUserIdentifier(Request $request)
    {
        if (!$request->hasCookie('user_identifier')) {
            $identifier = Str::uuid()->toString();
            cookie()->queue('user_identifier', $identifier, 60 * 24 * 30); // Cookie expires in 1 week
            return $identifier;
        }

        return $request->cookie('user_identifier');
    }

    public function getUserIdentifier(Request $request)
    {
        return $request->cookie('user_identifier') ?? $this->setUserIdentifier($request);
    }

    public function start($slug, Request $request)
    {
        $quiz = DareQuiz::where('slug', $slug)->firstOrFail();
        $existingResponse = DareResponse::where('dare_quiz_id', $quiz->id)
            ->where('identifier', $this->getUserIdentifier($request))
            ->first();

        // if ($existingResponse) {
        //     return redirect()->route('play.dare', $slug)
        //         ->with('error', 'You have already taken this quiz from this device.');
        // }

        return view('game.dare.start', compact('quiz'));
    }

    public function storeName($slug, Request $request)
    {
        $request->validate([
            'responder_name' => 'required|string|max:255',
        ]);

        // Simpan nama dan identifier ke session
        session([
            'responder_name' => $request->input('responder_name'),
            'identifier' => $this->getUserIdentifier($request),
        ]);

        return redirect()->route('dare-responses.create', ['slug' => $slug, 'currentQuestionIndex' => 1]);
    }

    public function create($slug, Request $request)
    {
        if (!session('responder_name')) {
            return redirect()->route('play.dare.start', $slug);
        }

        $currentQuestionIndex = $request->input('currentQuestionIndex', 1);

        $quiz = DareQuiz::with('questions')->where('slug', $slug)->first();

        $totalQuestions = $quiz->questions->count();

        $question = $quiz->questions->skip($currentQuestionIndex - 1)->first();
        // dd($question);
        $question->question = str_replace('kamu', $quiz->user->name, $question->question);

        if (!$question) {
            return redirect()->route('play.dare', $quiz->slug)
                ->with('error', 'No more questions available.');
        }

        if (is_string($question->options)) {
            $question->options = json_decode($question->options, true);
        }

        return view('game.dare.responses.create', compact('quiz', 'currentQuestionIndex', 'totalQuestions', 'question'));
    }

    public function store(Request $request)
    {
        $quiz = DareQuiz::findOrFail($request->input('quiz_id'));
        $currentQuestionIndex = $request->input('currentQuestionIndex', 1);
        $selectedAnswer = $request->input('response');

        $question = DareQuestion::where('dare_quiz_id', $quiz->id)
            ->skip($currentQuestionIndex - 1)
            ->first();

        if (!$question) {
            return redirect()->route('play.dare', $quiz->id)
                ->with('error', 'Question not found.');
        }

        // Cari atau buat response
        $response = DareResponse::firstOrCreate(
            [
                'dare_quiz_id' => $quiz->id,
                'identifier' => session('identifier'),
            ],
            [
                'responder_name' => session('responder_name'),
                'score' => 0,
                'time' => 0,
                'location' => $request->ip(),
                'device' => $request->header('User-Agent')
            ]
        );

        // Simpan jawaban
        DareAnswer::create([
            'dare_response_id' => $response->id,
            'dare_question_id' => $question->id,
            'selected_answer' => $selectedAnswer,
            'time' => $request->input('time') + 1,
        ]);

        // Jika sudah mencapai pertanyaan terakhir (20)
        if ($currentQuestionIndex == 20) {
            // Hitung jawaban yang benar
            $correctAnswers = DareAnswer::where('dare_response_id', $response->id)
                ->join('dare_questions', 'dare_answers.dare_question_id', '=', 'dare_questions.id')
                ->whereColumn('dare_answers.selected_answer', 'dare_questions.correct_answer')
                ->count();

            $timeAnswers = DareAnswer::where('dare_response_id', $response->id)->sum('time');

            // Update waktu dan skor
            $response->update([
                'score' => $correctAnswers,
                'time' => $timeAnswers,
            ]);

            return redirect()->route('play.dare', $quiz->slug)
                ->with('success', 'Quiz completed! Your score: ' . $correctAnswers);
        }

        // Lanjut ke pertanyaan berikutnya
        return redirect()->route('dare-responses.create', [
            'slug' => $quiz->slug,
            'currentQuestionIndex' => $currentQuestionIndex + 1,
        ]);
    }
}
