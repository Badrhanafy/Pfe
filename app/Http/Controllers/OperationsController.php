<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Artisan;
class OperationsController extends Controller
{
    public function Users(){
        $users =User::all();
        return view('adminpart.users.usersliste',compact('users'));
    }
    // public function Posts(){
    //     $posts = Post::all();
    //     return view("adminpart.posts.index");
    // }
//     public function blockUser($id)
// {
//     $user = User::findOrFail($id);
//     $user->is_blocked = true;
//     $user->save();

//     return response()->json(['message' => 'User has been blocked.']);
// }
public function deleteUser($id)
{
    $user = User::findOrFail($id);

    // optional: prevent admin from deleting himself
    if (auth()->user()->id == $user->id) {
        return back()->withErrors(['error' => 'You cannot delete your own account!']);
    }

    $user->delete();

    return back()->with('success', 'User deleted successfully!');
}
public function Artisans(){
    $artisans = Artisan::all();
    return view("adminpart.artisans.index",compact('artisans'));
}
public function posts()
{
    $posts = Post::withCount(['comments', 'likes'])
                ->with(['user'])
                ->latest()
                ->get();

    return view('adminpart.posts.index', compact('posts'));
}
public function deletePost($id){
    $post = Post::find($id);
    $post->delete();
    return back()->with('success', 'Post deleted successfully.');
}

}
