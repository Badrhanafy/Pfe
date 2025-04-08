<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reaction;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $post = new Post();
    $post->user_id = auth()->id();
    $post->content = $request->content;

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $post->image = $imageName;
    }

    $post->save();

    return redirect()->route('PostsIndex');
}

    public function react(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'type' => 'required|in:like,dislike',
        ]);

        $reaction = new Reaction();
        $reaction->post_id = $request->post_id;
        $reaction->user_id = auth()->id();
        $reaction->type = $request->type;
        $reaction->save();

        return redirect()->back();
    }

    public function comment(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id();
        $comment->content = $request->content;
        $comment->save();

        return redirect()->back();
    }
}