<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $comment = ArticleComment::create([
            'article_id' => $request->article_id,
            'user_id' => $request->user_id,
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully!',
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'user' => [
                    'name' => $comment->article->user->name,
                    'username' => $comment->article->user->username,
                    'avatar' => $comment->article->user->avatar ? asset($comment->user->avatar) : asset('assets/img/profpic.svg'),
                ],
                'created_at' => $comment->created_at->diffForHumans(),
            ],
        ]);
    }

    public function loadMoreComments($id, Request $request)
    {
        $offset = $request->query('offset', 0);
        $article = Article::findOrFail($id);
        $comments = $article->comments()->skip($offset)->take(5)->get();
        $totalComments = $article->comments()->count();

        return response()->json([
            'comments' => $comments,
            'totalComments' => $totalComments,
        ]);
    }
}
