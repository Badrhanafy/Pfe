<?php
namespace App\Http\Controllers;

use App\Models\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    public function SignUpForm(){
        return view('artisans.signUp');
    }
    public function showform(){
        return view('artisans.signUp');
    }
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:artisans,email',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            'profession' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
        ]);

        // Handle the photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        // Create new artisan record
        Artisan::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encrypt password
            'photo' => $photoPath,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'address' => $request->address,
            'bio' => $request->bio,
        ]);

        return redirect()->route('artisans.index')->with('success', 'Artisan created successfully');
    }
    //////// home
    public function index(Request $request)
{
    // Start with a Query Builder instance
    $query = Artisan::query();

    // Filter with search
    if ($request->filled('search')) {
        $query->where('name', 'like', "%{$request->search}%")
              ->orWhere('profession', 'like', "%{$request->search}%");
    }

    // Filter by profession
    if ($request->filled('profession')) {
        $query->where('profession', $request->profession);
    }

    // Filter by location
    if ($request->filled('location')) {
        $query->where('address', 'like', "%{$request->location}%");
    }

    // Apply pagination AFTER filtering
    $artisans = $query->paginate(9);

    // Get all unique professions for the dropdown
    $professions = Artisan::distinct('profession')->pluck('profession')->sort();

    return view('artisans.index', [
        'artisans' => $artisans,
        'professions' => $professions
    ]);
}
    
    public function test()
    {
        $artisans = Artisan::paginate(9);
        //$professions = Artisan::select('profession')->groupBy('profession')->pluck('profession')->sort();
        $professions = ['Carpenter', 'Electrician', 'Plumber', 'Painter'];
        return view('artisans.index', compact("artisans", "professions"));
    }
   //////// rating part 

   public function storeReview(Request $request)
{
    $request->validate([
        'artisan_id' => 'required|exists:artisans,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    Review::create([
        'artisan_id' => $request->artisan_id,
        'user_id' => auth()->id(),
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully!');
}

public function sendMessage(Request $request)
{
    $request->validate([
        'artisan_id' => 'required|exists:artisans,id',
        'message' => 'required|string|max:1000',
    ]);

    Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $request->artisan_id,
        'message' => $request->message,
    ]);

    return redirect()->back()->with('success', 'Message sent successfully!');
}
////// profile details
public function show(Artisan $artisan)
{
    $reviews = $artisan->reviews()->with('user')->latest()->paginate(5);
    
    return view('artisans.show', [
        'artisan' => $artisan,
        'reviews' => $reviews
    ]);
}
}
    
