<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return Post::with(['user', 'comments.user', 'reactions'])
            ->withCount([
                'reactions as likes_count' => fn($q) => $q->where('type', 'like'),
                'reactions as dislikes_count' => fn($q) => $q->where('type', 'dislike')
            ])
            ->orderBy('created_at', 'desc')
            ->get()
            ->each(function ($post) {
                $post->user_reaction = $post->reactions
                    ->where('user_id', auth()->id())
                    ->first()->type ?? null;
            });
    }
    
    public function comment(Request $request, Post $post)
    {
        $request->validate(['content' => 'required|string']);
        
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);
        
        return response()->json($comment->load('user'));
    }
}
