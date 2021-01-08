<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tag/{id}',[App\Http\Controllers\PostController::class, 'tag'])->name('tag');
Route::get('/posts/{post}/like', [\App\Http\Controllers\PostController::class, 'like'])->name('like');
Route::get('/liked',[App\Http\Controllers\PostController::class, 'liked'])->name('liked');


Route::middleware('auth')->group(function (){
    Route::get('/',[\App\Http\Controllers\PostController::class, 'index'])->name('posts.show');
    Route::get('create', [\App\Http\Controllers\PostController::class, 'create'])->name('create');
    Route::get('/posts/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('post.show');
    Route::post('posts/savepost', [\App\Http\Controllers\PostController::class, 'save'])->name('post.save');
    Route::get('posts/{id}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::put('posts/{id}/update', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::delete('posts/{id}/delete', [\App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');
});
