<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'type' => 'required|in:like,dislike',
        ]);

        // Check if user already reacted
        $existingReaction = Reaction::where('user_id', Auth::id())
                                    ->where('post_id', $post->id)
                                    ->first();

        if ($existingReaction) {
            // If same reaction type, remove it (toggle)
            if ($existingReaction->type === $request->type) {
                $existingReaction->delete();
                return redirect()->back();
            }
            
            // If different reaction type, update it
            $existingReaction->type = $request->type;
            $existingReaction->save();
            return redirect()->back();
        }

        // Create new reaction
        $reaction = new Reaction();
        $reaction->user_id = Auth::id();
        $reaction->post_id = $post->id;
        $reaction->type = $request->type;
        $reaction->save();

        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        Reaction::where('user_id', Auth::id())
                ->where('post_id', $post->id)
                ->delete();
                
        return redirect()->back();
    }
}