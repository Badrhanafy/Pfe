<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PostController;
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

/* Route::middleware(['auth.custom'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
}); */

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get("/Userlogin",[LoginController::class,'loginform'])->name('loginform');
Route::post("/Userlogin",[LoginController::class,'checklogin'])->name('checklogin');

//// SignUp routes for user
Route::get('/register', [LoginController::class, 'registerform'])->name('register');
Route::post('/register', [LoginController::class, 'usersave'])->name('usersave');

/// Admin
Route::get('/dashboard', [Admincontroller::class, 'Dashboard'])->name('Admindashboard');


///User
Route::get('/userIndex', [UserController::class, 'index'])->name('userIndex');
Route::get('/userProfile', [UserController::class, 'profile'])->name('userProfile');
Route::patch('/profile/{id}', [UserController::class, 'update'])->name('profileUpdate');
//index
Route::get('/artisans', [ArtisanController::class, 'index'])->name('artisans.index');
Route::get('/artisans/{id}', [ArtisanController::class, 'showform'])->name('artisans.show');


// //////////////////////Artisans routes 
//login
Route::get("ArtisanLogin",[ArtisanController::class,'loginForm'])->name("artisan.login");
Route::post("ArtisanLogin",[ArtisanController::class,'checkLogin'])->name("checkLogin");
 /// filter
 Route::post('/filter-artisans', [ArtisanController::class, 'filterArtisans'])->name('filterArtisans');

Route::get('CreateArtisan', [ArtisanController::class, 'showSignUpForm'])->name('showSignUpForm');
Route::post('artisans', [ArtisanController::class, 'store'])->name('artisans.store');
//profile details for artisan use 
Route::get('/artisans/{id}', [ArtisanController::class, 'profile'])->name('ArtisanProfile');
///// rating routes
Route::post('/artisans/{artisan}/reviews', [ArtisanController::class, 'storeReview'])->name('artisans.reviews.store');
Route::post('/messages', [ArtisanController::class, 'sendMessage'])->name('messages.send');

///// artisan profile
Route::get('/artisans/{artisan}/details', [ArtisanController::class, 'show'])->name('ArtProfile');
//Route::post('/messages', [MessageController::class, 'send'])->name('messages.send');

//// review routes 
Route::post('/artisans/{artisan}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
///// message 
Route::post('/messages', [UserController::class, 'sendMessage'])->name('messages.send');

///logout 
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



//// messages part
Route::get('/artisan/{artisanId}/messages', [ArtisanController::class, 'messages'])->name('Messagebox');  
// get user details to display more info
Route::get('/user/{name}', [UserController::class, 'findByName'])->name('user.find');





