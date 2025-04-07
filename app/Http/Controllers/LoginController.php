<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    ///// Sign up methods 
    public function registerform()
    {
        return view('user.register');
    }

    public function usersave(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'progilePhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            //'profession' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'gender' => 'required|string|in:male,female,other,prefer_not_to_say',
             'date_of_birth' => 'required|date',
        ]);
    
        // Handle file upload if a file is provided
        $fileName = null;
        if ($request->hasFile('progilePhoto')) {
            $file = $request->file('progilePhoto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/photos', $fileName);
        }
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'progilePhoto' => $fileName, // Save the file name if a file was uploaded
            //'profession' => $request->profession,
            'phone' => $request->phone,
            'address' => $request->address,
            'bio' => $request->bio,
            'date_of_birth'=>$request->date_of_birth,
            'gender'=>$request->gender,
        ]);
    
        return to_route('loginform')->with("success", "The account was successfully created!");
    }

    /////// login methods 
    public function loginform(){
        return view('user.login');
    }
    public function checklogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $artisans = Artisan::all();
            $professions = $artisans->pluck('profession')->unique();
            if ($user->role === 'admin') {
                return redirect()->route('Admindashboard')->with("success","Welcome to the main home");
            } else {
                return view('artisans.index',compact('artisans','professions'));
            }
        }
    
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    //// logout

    public function logout(Request $request)
    {
        Auth::logout(); // Kaydir logout l user
       
        Session::flush(); // Clear all session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/Userlogin');
    }

    
    
}
