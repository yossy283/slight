<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FavoritesController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ログインしたときにしかアクセスできない
Route::group(['middleware' => 'auth'], function() {
    //Resourceとは,CRUD操作(create,read,update,delete)を予め決められた処理を簡潔にできる機能のこと
    //UsersControllerというcontrollerをresourceと紐づけて作成したので、利用可能
    //ユーザー機能では一覧/詳細/編集/更新のみを使用する
    Route::resource('users', UsersController::class, ['only' => ['index', 'show', 'edit', 'update']]);

    // フォロー/フォロー解除を追加
    Route::post('users/{user}/follow', [UsersController::class, 'follow'])->name('follow');
    Route::delete('users/{user}/unfollow', [UsersController::class, 'unfollow'])->name('unfollow');
    //フォロー・フォロワー表示用
    Route::get('/users/{user}/follows', [UsersController::class, 'index_follows'])->name('follows');
    Route::get('/users/{user}/followers', [UsersController::class, 'index_followers'])->name('followers');

    // ツイート関連
    Route::resource('tweets', TweetsController::class, ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);

    // コメント関連
    Route::resource('comments', CommentsController::class, ['only' => ['store']]);

    // いいね関連
    Route::resource('favorites', FavoritesController::class, ['only' => ['store', 'destroy']]);
});
