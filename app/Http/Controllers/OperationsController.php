<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
class OperationsController extends Controller
{
    public function Users(){
        $users =User::all();
        return view('adminpart.users.usersliste',compact('users'));
    }
    public function Posts(){
        $posts = Post::all();
        return view("adminpart.posts.index");
    }
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

}
