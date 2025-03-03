<?php

namespace App\Http\Controllers;

use App\Models\ArticleReaction;
use Illuminate\Http\Request;

class ArticleReactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'nullable|string',
        ]);

        $reaction = ArticleReaction::firstOrCreate(
            [
                'article_id' => $request->article_id,
                'user_id' => $request->user_id,
            ],
            [
                'content' => $request->content,
            ]
        );

        $reaction->update([
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'Reaction added successfully!');
    }
}
