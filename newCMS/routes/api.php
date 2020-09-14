<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('posts', PostController::class);
//Post
Route::get('posts/index',[PostController::class,'index']);
Route::get('posts/{id}',[PostController::class,'show']);
Route::post('posts/create',[PostController::class,'store']);
Route::put('posts/update/{id}',[PostController::class,'update']);
Route::delete('posts/delete/{id}',[PostController::class,'destroy']);

// Route::post('/comments/{post}/create',[CommentController::class,'store'] );
