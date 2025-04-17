<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('userpart.index');
    }
    public function sendMessage(Request $request)
    {
        // Validate the request
        $request->validate([
            'artisan_id' => 'required|exists:artisans,id',
            'message' => 'required|string|max:1000',
        ]);

        // Create a new message
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->artisan_id,
            'message' => $request->message,
        ]);

        // Redirect back with a success message
        return back()->with('success', 'Message sent successfully!');
    }
    public function profile(){
        return view("user.profile");
    }
    /// Update infos
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
     //dd($user);
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'bio' => 'nullable|string|max:500',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
        'gender' => 'string|in:male,female,other,prefer_not_to_say',
        'date_of_birth' => 'date',
    ]);

    // Handle file upload if a file is provided
    if ($request->hasFile('profile_photo')) {
        // Delete the old profile photo if it exists
        if ($user->progilePhoto) {
            Storage::delete('public/photos/' . $user->progilePhoto);
        }

        $file = $request->file('profile_photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/photos', $fileName);

        $user->progilePhoto = $fileName;
    }

    // Update user information
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'bio' => $request->bio,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        
    ]);

    return back()->with('success', 'Profile updated successfully!');
}
public function findByName($name)
{
    $user = User::where('name', $name)->firstOrFail();

    return response()->json($user);
}
/////////////////// post creation 
public function createPost()
{
    return view('posts.create');
}
public function UserPosts(){
    
    $user = User::find(Auth::id());
    $Userposts = $user->posts;
    return view('user.myPosts', compact('Userposts'));

}
}

