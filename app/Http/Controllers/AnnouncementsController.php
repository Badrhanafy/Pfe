<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
class AnnouncementsController extends Controller
{
    public function createForm(){
        return view("adminpart.announcements.create");
    }
    public function index(){
        return view("adminpart.announcements.index");
    }
    public function publish(Request $request){
        $form = $request->validate([
            "title" => "required|max:50",
            "body" => "required|min:4",
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
        ]);
        
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/announcements', $filename);
       // dd($request->all());
        Announcement::create([
            "title" => $request->title,
            "body" => $request->body,
            "admin_id" => Auth::user()->id,
            'image' => 'storage/announcements/' . $filename
        ]);
    }

}
