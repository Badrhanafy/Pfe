<?php

namespace App\Http\Controllers;
use App\Models\Messages;
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
        Messages::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->artisan_id,
            'message' => $request->message,
        ]);

        // Redirect back with a success message
        return back()->with('success', 'Message sent successfully!');
    }
}
