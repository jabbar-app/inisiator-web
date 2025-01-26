<?php

namespace App\Http\Controllers;

use App\Models\DareQuestion;
use App\Models\DareTemplate;
use Illuminate\Http\Request;

class DareQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($quiz_id)
    {
        $questions = DareQuestion::where('quiz_id', $quiz_id)->get();
        return view('game.dare.questions.index', compact('questions', 'quiz_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($quiz_id, Request $request)
    {
        $currentQuestionIndex = $request->input('currentQuestionIndex', 1);

        // Ambil template pertanyaan berdasarkan index
        $templateQuestion = DareTemplate::skip($currentQuestionIndex - 1)->first();

        if ($templateQuestion) {
            $templateQuestion->options = json_decode($templateQuestion->options, true); // Decode options JSON ke array
        }

        return view('game.dare.questions.create', compact('quiz_id', 'currentQuestionIndex', 'templateQuestion'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:dare_quizzes,id',
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'correct_answer' => 'required|string|max:255',
            'currentQuestionIndex' => 'required|integer|min:1|max:20',
        ]);

        DareQuestion::create([
            'dare_quiz_id' => $request->input('quiz_id'),
            'question' => $request->input('question'),
            'options' => json_encode($request->input('options')),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        $currentIndex = $request->input('currentQuestionIndex');

        if ($request->has('next') && $currentIndex < 20) {
            return redirect()->route('dare-questions.create', [
                'quiz_id' => $request->input('quiz_id'),
                'currentQuestionIndex' => $currentIndex + 1,
            ])->with('success', 'Question saved successfully. Add the next question.');
        } elseif ($request->has('finish')) {
            return redirect()->route('dare-quizzes.show', $request->input('quiz_id'))
                ->with('success', 'All questions have been added successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DareQuestion $dareQuestion)
    {
        return view('game.dare.questions.show', compact('dareQuestion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DareQuestion $dareQuestion)
    {
        return view('game.dare.questions.edit', compact('dareQuestion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DareQuestion $dareQuestion)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'correct_answer' => 'required|string|max:255',
        ]);

        $dareQuestion->update([
            'question' => $request->input('question'),
            'options' => json_encode($request->input('options')),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        return redirect()->route('dare-questions.index', $dareQuestion->quiz_id)
            ->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DareQuestion $dareQuestion)
    {
        $quiz_id = $dareQuestion->quiz_id; // Get the quiz_id before deleting
        $dareQuestion->delete();

        return redirect()->route('dare-questions.index', $quiz_id)
            ->with('success', 'Question deleted successfully.');
    }
}
