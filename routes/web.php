<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPostController;

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


Auth::routes();

Route::get('/',[\App\Http\Controllers\PostController::class,'index'])->name('index');

Route::get('posts/{slug}',[\App\Http\Controllers\PostController::class,'view'])->name('post.view');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Debug test3
Route::get('/user/posts', [UserPostController::class, 'posts'])->name('user.posts');
