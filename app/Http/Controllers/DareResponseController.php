<?php

namespace App\Http\Controllers;

use App\Models\DareAnswer;
use App\Models\DareQuestion;
use App\Models\DareQuiz;
use App\Models\DareResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DareResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $quiz_id = $request->input('quiz_id');
        $currentQuestionIndex = $request->input('currentQuestionIndex', 1);

        // Ambil kuis
        $quiz = DareQuiz::with('questions')->findOrFail($quiz_id);

        // Ambil total pertanyaan
        $totalQuestions = $quiz->questions->count();

        // Ambil pertanyaan berdasarkan index
        $question = $quiz->questions->skip($currentQuestionIndex - 1)->first();

        if (!$question) {
            return redirect()->route('dare-quizzes.show', $quiz_id)
                ->with('error', 'No more questions available.');
        }

        // Decode options jika diperlukan
        if (is_string($question->options)) {
            $question->options = json_decode($question->options, true);
        }

        return view('game.dare.responses.create', compact('quiz_id', 'currentQuestionIndex', 'totalQuestions', 'question'));
    }

    public function store(Request $request)
    {
        $quiz_id = $request->input('quiz_id');
        $currentQuestionIndex = $request->input('currentQuestionIndex', 1);
        $selectedAnswer = $request->input('response');

        // Ambil pertanyaan berdasarkan index
        $question = DareQuestion::where('dare_quiz_id', $quiz_id)
            ->skip($currentQuestionIndex - 1)
            ->first();

        if (!$question) {
            return redirect()->route('dare-quizzes.show', $quiz_id)
                ->with('error', 'Question not found.');
        }

        // Ambil atau buat respon baru jika belum ada
        $response = DareResponse::firstOrCreate(
            ['dare_quiz_id' => $quiz_id],
            ['responder_name' => 'Anonymous', 'score' => 0, 'time' => 0, 'location' => $request->ip(), 'device' => $request->header('User-Agent')]
        );

        // Simpan jawaban pengguna di tabel dare_answers
        DareAnswer::create([
            'dare_response_id' => $response->id,
            'dare_question_id' => $question->id,
            'selected_answer' => $selectedAnswer,
        ]);

        // Jika pertanyaan terakhir
        if ($currentQuestionIndex == 20) {
            // Hitung skor
            $correctAnswers = DareAnswer::where('dare_response_id', $response->id)
                ->join('dare_questions', 'dare_answers.dare_question_id', '=', 'dare_questions.id')
                ->whereColumn('dare_answers.selected_answer', 'dare_questions.correct_answer')
                ->count();

            $response->update(['score' => $correctAnswers]);

            // Redirect ke halaman hasil kuis
            return redirect()->route('dare-quizzes.show', $quiz_id)
                ->with('success', 'Quiz completed! Your score: ' . $correctAnswers);
        }

        // Redirect ke pertanyaan berikutnya
        return redirect()->route('dare-responses.create', [
            'quiz_id' => $quiz_id,
            'currentQuestionIndex' => $currentQuestionIndex + 1,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(DareResponse $dareResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DareResponse $dareResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DareResponse $dareResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DareResponse $dareResponse)
    {
        //
    }
}
