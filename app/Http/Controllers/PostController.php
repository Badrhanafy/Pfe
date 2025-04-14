<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.user', 'reactions.user'])
                    ->latest()
                    ->paginate(10);
        
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $post->image = $path;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user', 'reactions.user']);
        return view('posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        
        $post->delete();
        
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}