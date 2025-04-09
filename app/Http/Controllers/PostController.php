<?php

namespace App\Http\Controllers;
// app/Http/Controllers/PostController.php

use App\Models\Post;
use App\Models\Reaction;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Events\NewPostEvent;
use App\Events\NewCommentEvent;
use App\Events\ReactionUpdatedEvent;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.user', 'reactions'])->latest()->get();
        return view('posts.index', compact('posts'));
    }
    public function create(){
        return view("posts.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);
        
        $post = new Post();
        $post->user_id = auth()->id();
        $post->content = $request->content;
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $post->image = $path;
        }
        
        $post->save();
        
        // Broadcast the new post
        broadcast(new NewPostEvent($post))->toOthers();
        
        return redirect()->route('posts.index');
    }
    
    public function react(Request $request, Post $post)
    {
        $request->validate([
            'type' => 'required|in:like,dislike'
        ]);
        
        // Remove any existing reaction from this user
        $post->reactions()->where('user_id', auth()->id())->delete();
        
        // Add new reaction
        $reaction = new Reaction();
        $reaction->user_id = auth()->id();
        $reaction->post_id = $post->id;
        $reaction->type = $request->type;
        $reaction->save();
        
        // Broadcast the reaction update
        broadcast(new ReactionUpdatedEvent($post))->toOthers();
        
        return response()->json(['success' => true]);
    }
    
    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required'
        ]);
        
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->content = $request->content;
        $comment->save();
        
        // Load the user relationship for broadcasting
        $comment->load('user');
        
        // Broadcast the new comment
        broadcast(new NewCommentEvent($comment))->toOthers();
        
        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }
}