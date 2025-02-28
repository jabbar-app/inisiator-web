<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DareMessage;
use App\Models\DareQuiz;

class DareMessageController extends Controller
{
    // Menampilkan form untuk mengirim pesan
    public function create($quizId)
    {
        $quiz = DareQuiz::findOrFail($quizId);
        return view('dare-messages.create', compact('quiz'));
    }

    // Menyimpan pesan yang dikirim
    public function store(Request $request)
    {
        $request->validate([
            'dare_quiz_id' => 'required|exists:dare_quizzes,id',
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DareMessage::create([
            'dare_quiz_id' => $request->dare_quiz_id,
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    // Menghapus pesan
    public function destroy($id)
    {
        $message = DareMessage::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully!');
    }
}
