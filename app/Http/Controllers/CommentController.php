<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->save();
       // dd(Auth::user());
        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
       
        
        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}