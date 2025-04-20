<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;

class HomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('welcome', compact('carousels')); // ola index
    }
}
