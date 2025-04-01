<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    ///// Sign up methods 
    public function registerform()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:admin,user',
            'prohilePhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'progilePhoto' => $request->photoProfile,
        ]);

        Auth::login($user);

        return to_route('loginform')->with("success","the account was successfuly created !");
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
            if ($user->role === 'admin') {
                return redirect()->route('Admindashboard')->with("success","Welcome to the main home");
            } else {
                return view('artisans.index',compact('artisans'));
            }
        }
    
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    //// logout

    public function logout(Request $request)
    {
        Auth::logout(); // Kaydir logout l user
        
        $request->session()->invalidate(); // Kayms7 session
        $request->session()->regenerateToken(); // Kayjib token jdida

        return redirect('/Userlogin')->with('success', 'You have been logged out.');
    }

    
    
}
