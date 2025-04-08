<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('posts', PostsController::class);
Route::post('/posts/{id}/react', [PostsController::class, 'react']);
// Route::get('/posts', [PostController::class, 'index']);
// Route::post('/posts/react', [PostController::class, 'react']);
// Route::post('/posts/comment', [PostController::class, 'comment']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/posts/{post}/comment', [PostController::class, 'storeComment']);


