<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;


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
Route::group(['prefix' => 'post','middleware' => 'auth'],function(){
    Route::get('create',[PostController::class,'create'])->name('post.create');
    Route::post('store',[PostController::class,'store'])->name('post.store');
    Route::get('show/{post}',[PostController::class,'show'])->name('post.show');
    Route::get('edit/{post}',[PostController::class,'edit'])->name('post.edit');
    Route::post('update/{post}',[PostController::class,'update'])->name('post.update');
    Route::post('destroy/{post}',[PostController::class,'destroy'])->name('post.destroy');

    Route::post('comment/store',[CommentController::class,'store'])->name('comment.store');
    Route::get('/mypost',[HomeController::class,'mypost'])->name('home.mypost');
    Route::get('/mycomment',[HomeController::class,'mycomment'])->name('home.mycomment');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
