<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\ReviewController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth.custom'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get("/Userlogin",[LoginController::class,'loginform'])->name('loginform');
Route::post("/Userlogin",[LoginController::class,'checklogin'])->name('checklogin');

//// SignUp routes for user
Route::get('/register', [LoginController::class, 'registerform'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('saveUser');

/// Admin
Route::get('/dashboard', [Admincontroller::class, 'Dashboard'])->name('Admindashboard');


///User
Route::get('/userIndex', [UserController::class, 'index'])->name('userIndex');
//index
Route::get('/artisans', [ArtisanController::class, 'index'])->name('artisans.index');
Route::get('/artisans/{id}', [ArtisanController::class, 'showform'])->name('artisans.show');


// Artisans routes 


Route::get('artisans/create', [ArtisanController::class, 'SignUpForm'])->name('SignUpForm');
Route::post('artisans', [ArtisanController::class, 'store'])->name('artisans.store');

///// rating routes
Route::post('/artisans/{artisan}/reviews', [ArtisanController::class, 'storeReview'])->name('artisans.reviews.store');
Route::post('/messages', [ArtisanController::class, 'sendMessage'])->name('messages.send');

///// artisan profile
Route::get('/artisans/{artisan}/details', [ArtisanController::class, 'show'])->name('profile');
//Route::post('/messages', [MessageController::class, 'send'])->name('messages.send');

//// review routes 
Route::post('/artisans/{artisan}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
///// message 
Route::post('/messages', [UserController::class, 'sendMessage'])->name('messages.send');

///logout 
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
