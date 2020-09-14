<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();
Route::get('/posts/{post}', [PostController ::class,'single']);
//Route::resource('/posts', PostController::class);
Route::get('/user',[ProductController::class,'index']);

Route::get('/', [PostController::class,'all']);

Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/users', [HomeController::class ,'getUsers'])->name('users');
Route::get('/admin/{any}', [AdminController::class,'index'])->where('any', '.*');



Route::get('/comments/{post}',[CommentController::class,'index'] );
Route::post('/comments/{post}/create',[CommentController::class,'store'] );
