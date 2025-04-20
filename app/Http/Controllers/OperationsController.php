<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\SiteSetting;
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

// public function Artisans(){
//     $artisans = Artisan::all();
//     return view("adminpart.artisans.index",compact('artisans'));
// }

public function artisans(Request $request)
{
    $query = Artisan::withAvg('reviews', 'rating');

    // Location filter
    if ($request->filled('location')) {
        $query->where('address', $request->location);
    }

    // Sorting
    switch ($request->sort) {
        case 'highest_rated':
            $query->orderByDesc('reviews_avg_rating');
            break;
        case 'most_experience':
            $query->orderByDesc('experience_years');
            break;
        case 'newest':
        default:
            $query->latest();
            break;
    }

    $artisans = $query->paginate(10)->withQueryString();
    $locations = Artisan::distinct()->pluck('address');

    return view('adminpart.artisans.index', compact('artisans', 'locations'));
}
public function destroyArtisan($id){
    $artisan = Artisan::find($id);
    $artisan->delete();
    return back()->with("success","artisan was successfuly deleted !");
}
public function showArtisan($id)
{
    $artisan = Artisan::findOrFail($id);
    return response()->json($artisan);
}

public function updateArtisan(Request $request)
{
    $artisan = Artisan::findOrFail($request->id);
    //dd($request->all());

    $artisan->update([
        'name' => $request->name,
        'email' => $request->email,
        'profession' => $request->profession,
        'address' => $request->address,
        'experience_years' => $request->experience_years, // ولا experience_years إلا كان داكشي متناسق
    ]);

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('artisans', 'public');
        $artisan->photo = $path;
        $artisan->save();
    }

    return redirect()->back()->with('success', 'Artisan updated successfully!');
}
public function settings(){
    $setting = SiteSetting::first(); // ila 3andk row wa7ed
    return view("adminpart.settings.index",compact('setting'));
}
public function changeImages(Request $request)
{
    $setting = SiteSetting::first(); // ila 3andk row wa7ed

    if ($request->hasFile('slider_image')) {
        $filename = $request->file('slider_image')->store('public/images');
        $setting->slider_image = str_replace('public/', 'storage/', $filename);
    }

    if ($request->hasFile('banner_image')) {
        $filename = $request->file('banner_image')->store('public/images');
        $setting->banner_image = str_replace('public/', 'storage/', $filename);
    }

    $setting->save();

    return back()->with('success', 'Settings updated!');
}


}
