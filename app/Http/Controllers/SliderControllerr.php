<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Carousel;
class SliderControllerr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousels = Carousel::all();
        return view('adminpart.Carousel.index', compact('carousels'));
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('adminpart.Carousel.edit', compact('carousel'));
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            Storage::delete($carousel->image);
            // Stocker la nouvelle
            $path = $request->file('image')->store('public/carousels');
            $carousel->image = str_replace('public/', 'storage/', $path);
        }

        $carousel->title = $request->title;
        $carousel->description = $request->description;
        $carousel->save();

        return back()->with('success', 'Carousel updated!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function create()
{
    return view('adminpart.Carousel.create');
}

public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5048',
    ]);

    $filename = time() . '.' . $request->image->extension();

    // Store the image
    $request->image->storeAs('public/carousels', $filename);

    // Save the full path for frontend access
    Carousel::create([
        'image' => 'storage/carousels/' . $filename
    ]);

    return redirect()->route('admin.carousels.create')->with('success', 'Image uploaded successfully!');
}


}
