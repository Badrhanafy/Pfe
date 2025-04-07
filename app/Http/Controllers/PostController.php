<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;

class PostController extends Controller
{
     public function create(){
        return view('posts.create');
     }
    public function index(){
        $posts = Post::all();
        return view('posts.index',compact("posts"));
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('public/images');
        }

        $post = new Post();
        $post->user_id = auth()->id();
        $post->content = $request->content;
        $post->image = $imagePath;
        $post->save();

        return redirect()->route('posts.index');
    }

    public function like(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $reaction = Reaction::firstOrNew(['user_id' => auth()->id(), 'post_id' => $postId]);
        $reaction->type = 'like';
        $reaction->save();
        return back();
    }
    public function dislike(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $reaction = Reaction::firstOrNew(['user_id' => auth()->id(), 'post_id' => $postId]);
        $reaction->type = 'dislike';
        $reaction->save();
        return back();
    }

}
