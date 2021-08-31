<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use \App\Http\Controllers\Admin\PostController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;





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


Route::get('/', [\App\Http\Controllers\PostController::class,'index'])->name('home');
Route::post('/', [\App\Http\Controllers\SubscriberController::class,'store'])->name('home');
Route::get('/article/{slug}', [\App\Http\Controllers\PostController::class,'show'])->name('posts.single');
Route::post('/article/{slug}', [CommentController::class,'store'])->name('posts.single');
Route::get('/category/{slug}',[\App\Http\Controllers\CategoryController::class, 'show'])->name('categories.single');
Route::get('/tag/{slug}',[\App\Http\Controllers\TagController::class, 'show'])->name('tags.single');
Route::get('/search', [SearchController::class, 'search'])->name('search');

//Admin
Route::group(['prefix'=>'admin', 'middleware' =>'admin'], function(){
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/posts', PostController::class);
});

Route::group(['middleware'=>'guest'],function (){
    //Registration
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');

    //Login
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

//Logout
Route::get('/logout', [UserController::class,'logout'])->name('logout')->middleware('auth');




