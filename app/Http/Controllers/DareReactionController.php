<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DareReaction;
use App\Models\DareQuiz;

class DareReactionController extends Controller
{
    // Menyimpan reaksi
    public function store(Request $request)
    {
        $request->validate([
            'dare_quiz_id' => 'required|exists:dare_quizzes,id',
            'name' => 'required|string|max:255',
            'identifier' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $reaction = DareReaction::firstOrCreate(
            [
                'dare_quiz_id' => $request->dare_quiz_id,
                'identifier' => $request->identifier,
            ],
            [
                'name' => $request->name,
                'content' => $request->content,
            ]
        );

        $reaction->update([
            'name' => $request->name,
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'Reaction added successfully!');
    }

    // Menghapus reaksi
    public function destroy($id)
    {
        $reaction = DareReaction::findOrFail($id);
        $reaction->delete();

        return redirect()->back()->with('success', 'Reaction removed successfully!');
    }
}
