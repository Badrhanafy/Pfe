<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use App\Models\Post;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\MessageSent;
use App\Models\Artisan;
use Illuminate\Support\Facades\Hash;
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
       $message =  Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->artisan_id,
            'message' => $request->message,
        ]);
        /// notify artisn
        $artisan = Artisan::find($request->artisan_id);
        
        $senderName = User::find(auth()->id())->name;
        //dd($senderName);
         $artisan->notify(new MessageSent($senderName));

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
    $form = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'bio' => 'nullable|string|max:500',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
        'gender' => 'string|in:male,female,other,prefer_not_to_say',
        'date_of_birth' => 'date',
        'role' => 'string|in:user,admin,',
       // 'statut' => 'required|in:0,1',
        
    ]);

    
    //dd($request->all());
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
  $dataToUpdate = [
    'name' => $request->name,
    'email' => $request->email,
    'is_blocked' => (int) $request->input('is_blocked'),
];

// Zayd les champs ila kaynin
if ($request->filled('phone')) {
    $dataToUpdate['phone'] = $request->phone;
}

if ($request->filled('gender')) {
    $dataToUpdate['gender'] = $request->gender;
}

if ($request->filled('date_of_birth')) {
    $dataToUpdate['date_of_birth'] = $request->date_of_birth;
}

if ($request->filled('password')) {
    $dataToUpdate['password'] = Hash::make($request->password);
}
if ($request->filled('role')) {
    $dataToUpdate['role'] = $request->role;
}

$user->update($dataToUpdate);

   // dd($user->is_blocked);

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
public function artisansIndex(){
    $announcements = Announcement::latest()->take(6)->get();
    return view("artisans.index",compact("announcements"));
}
}

