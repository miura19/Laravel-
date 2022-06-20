<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use PhpParser\Node\Expr\AssignOp\Pow;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|1111111111111111
|2222222222222222
|3333333333333333
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//メール認証
Auth::routes(['verify' => true]);
// Auth::routes();
//ログイン画面
Route::get('/',function(){
    return view('auth.login');
});

//お問い合わせ
Route::group(['prefix' => 'contact','middleware' => 'guest'],function(){
    Route::get('create',[ContactController::class,'create'])->name('contact.create');
    Route::post('store',[ContactController::class,'store'])->name('contact.store');
});

Route::middleware(['verified'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    //プロフィール編集
    Route::get('profile/{user}/edit',[ProfileController::class,'edit'])->name('profile.edit');
    Route::post('/profile/{user}',[ProfileController::class,'update'])->name('profile.update');
});
//投稿のCRUDとコメント
Route::group(['prefix' => 'post','middleware' => 'verified'],function(){
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

//管理者用画面
Route::middleware(['can:admin'])->group(function(){
    Route::group(['prefix' => 'profile'],function(){
        Route::get('/index',[ProfileController::class,'index'])->name('profile.index');
        Route::delete('/delete/{user}', [ProfileController::class,'delete'])->name('profile.delete');
    });
    Route::group(['prefix' => 'roles'],function(){
        Route::put('/{user}/attach', [RoleController::class,'attach'])->name('role.attach');
        Route::put('/{user}/detach', [RoleController::class,'detach'])->name('role.detach');
    });
});

