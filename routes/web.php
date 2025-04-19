<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperationsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\CommentController;
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
Route::get('/artisans/{id}', [ArtisanController::class, 'show'])->name('artisans.show');


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

////////////post part 
/* 
Route::get('/PostsIndex', [PostController::class, 'index'])->name('PostsIndex');
Route::get('/posts/create', [PostController::class, 'create'])->name('CreatePost');
Route::post('/posts', [PostController::class, 'store'])->name('savePost');
Route::post('/posts/react', [PostController::class, 'react'])->name('react');
Route::post('/posts/comment', [PostController::class, 'comment'])->name('SaveComment');

Route::get('/react-posts', fn () => view('reactPosts')); */



// routes/web.php
//Route::middleware(['auth'])->group(function() {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/CreatePost', [PostController::class, 'create'])->name('CreatePost');
    Route::post('/posts', [PostController::class, 'store'])->name('savePost');
    Route::post('/posts/{post}/react', [PostController::class, 'react'])->name('posts.react');
    Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');
//});
Route::get('/myPosts', [UserController::class, 'UserPosts'])->name("userPosts");

////////// update artisan profile info


    

////////// Posts Part 
//Route::middleware(['auth'])->group(function () {
    // Posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    
    // Comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Reactions
    Route::post('/posts/{post}/reactions', [ReactionController::class, 'store'])->name('reactions.store');
    Route::delete('/posts/{post}/reactions', [ReactionController::class, 'destroy'])->name('reactions.destroy');
//});





/////////////////Admin Operations

Route::get("Admin/AllUsers", [OperationsController::class, "users"])->name("users");
Route::get("/Admin/Posts",[OperationsController::class,"Posts"])->name("AllPosts");
Route::get("/Admin/Artisans",[OperationsController::class,"Artisans"])->name("Artisans");
Route::delete('/users/{id}', [OperationsController::class, 'destdeleteUserroy'])->name('User.destroy');
// routes/web.php
Route::delete('/admin/posts/{post}', [OperationsController::class, 'deletePost'])->name('removePost');

///// mochkil dyal routes mn hadou hhh
Route::get('/{artisan}', [ArtisanController::class, 'show'])->name('artisan.show');
Route::put('/{artisan}', [ArtisanController::class, 'update'])->name('artisan.update');


