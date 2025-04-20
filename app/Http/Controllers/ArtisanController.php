<?php
namespace App\Http\Controllers;

use App\Models\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Notifications\NewUserMessageNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ArtisanCreated;
class ArtisanController extends Controller
{
    public function showSignUpForm(){
        return view('artisans.register');
    }
   /*  public function showform(){
        return view('artisans.signUp');
    } */
    public function store(Request $request)
    {
        // Validate form data
       $artisanfields =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:artisans,email',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            'profession' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'experience_years' => 'nullable|integer|min:1',
        ]);
      //dd($artisan);

        // Handle the photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        // Create new artisan record
       $artisan =  Artisan::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encrypt password
            'photo' => $photoPath,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'address' => $request->address,
            'bio' => $request->bio,
            'experience_years' => $request->experience_years,
        ]);
         $id = $artisan['id'];
         // Send notification directly to artisan
         //$artisan->notify(new ArtisanCreated());
        return view('artisans.homepage',compact('id','artisan'))->with('success', 'Artisan created successfully');
    }
    //////// home
    public function index(Request $request)
    {
        $query = Artisan::query()
            ->withCount(['reviews as reviews_count'])
            ->withAvg(['reviews as average_rating'], 'rating')
            ->when($request->search, function($q) use ($request) {
                $q->where(function($query) use ($request) {
                    $query->where('name', 'like', "%{$request->search}%")
                          ->orWhere('profession', 'like', "%{$request->search}%");
                });
            })
            ->when($request->profession, fn($q, $prof) => $q->where('profession', $prof))
            ->when($request->location, fn($q, $loc) => $q->where('address', 'like', "%{$loc}%"));

        // Apply sorting
        switch ($request->sort) {
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'rating_asc':
                $query->orderBy('average_rating', 'asc');
                break;
            case 'rating_desc':
                $query->orderBy('average_rating', 'desc');
                break;
            default: // name_asc
                $query->orderBy('name', 'asc');
        }

        $professions = Artisan::distinct('profession')
            ->orderBy('profession')
            ->pluck('profession');

        return view('artisans.index', [
            'artisans' => $query->paginate(12),
            'professions' => $professions,
            'filters' => $request->only(['search', 'profession', 'location', 'sort'])
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
    
    $artisan = Artisan::fin($request->artisan_id);
    $artisan->notify(new NewUserMessageNotification($message));
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
public function filterArtisans(Request $request)
    {
        $search = $request->input('search');
        $profession = $request->input('profession');
        $location = $request->input('location');

        $query = Artisan::query();

        if (!empty($search)) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('profession', 'LIKE', "%{$search}%");
        }

        if (!empty($profession)) {
            $query->where('profession', $profession);
        }

        if (!empty($location)) {
            $query->where('address', 'LIKE', "%{$location}%");
        }

        $artisans = $query->get();

        return response()->json(['artisans' => $artisans]);
    }
    public function profile($id)
    {
        $artisan = Artisan::findOrFail($id);
        
        return view('artisans.profile', [
            'artisan' => $artisan
        ]);
    }
     /// messages part 
    public function messages($artisanId)
    {
        $artisan = Artisan::findOrFail($artisanId);
        $messages = $artisan->messages()->with('sender')->latest()->get();

        return view('artisans.messages', compact('messages'));
    }
    ///////////////////////// login part

    public function loginform(){
        return view('artisans.login');
    }
    public function checkLogin(Request $req){
        
        $credentials = [
            'email'=>$req->email,
            'password'=>$req->password,
        ];
        if(Auth::guard('artisans')->attempt($credentials)){
            $artisan = Artisan::where('email', $req->email)->first();
            Auth::guard("artisans")->login($artisan);
            return redirect("artisans/$artisan->id");
          // return redirect('artisans/'.$artisan["id"].'/details');
        }
        else{
            return  back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
    /////////// to update the ifo of profile 

    public function update(Request $request, Artisan $artisan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:artisans,email,'.$artisan->id,
            'bio' => 'nullable|string',
            'experience_years' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($artisan->photo) {
                Storage::delete('public/' . $artisan->photo);
            }

            $photoPath = $request->file('photo')->store('artisan_photos', 'public');
            $validated['photo'] = $photoPath;
        }

        // Update the artisan
        $artisan->update($validated);

        //return redirect()->route('artisan.show', $artisan)->with('success', 'Profile updated successfully!');
        return back()->with('success', 'Profile updated successfully!');
    }


}
    
