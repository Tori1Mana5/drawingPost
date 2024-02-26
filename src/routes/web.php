<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

// ログインした後に許可する
Route::middleware(['can:isLogin'])->group(function () {
    // 投稿画面
    Route::get('/posts/store/', [PostController::class, 'store'])->name('post.store');
    
    // 投稿した内容の登録処理
    Route::post('/posts/store/complete/', [PostController::class, 'storeComplete'])->name('post.store.complete');
    
    // 投稿内容の編集画面
    Route::get('/posts/edit/{postId}/', [PostController::class, 'edit'])->name('post.edit');

    // 投稿内容の編集処理
    Route::post('/posts/edit/{postId}/complete/', [PostController::class, 'editComplete'])->name('post.edit.complete');

    // ログアウト
    Route::get('/users/logout/', [LogoutController::class, 'logout'])->name('user.logout');

    // プロフィール登録画面
    Route::get('/profiles/{userName}/register/', [ProfileController::class, 'register'])->name('profile.register');

    // プロフィール登録処理
    Route::post('/profiles/{userName}/register/complete/', [ProfileController::class, 'registerComplete'])->name('profile.register.complete');

    // プロフィール編集画面
    Route::get('/profiles/{userName}/edit/', [ProfileController::class, 'edit'])->name('profile.edit');

    // プロフィール編集処理
    Route::post('profiles/{userName}/edit/complete/', [ProfileController::class, 'editComplete'])->name('profile.edit.complete');
});

// 投稿一覧画面
Route::get('/posts/', [PostController::class, 'index'])->name('post');

// ユーザー登録画面
Route::get('/users/register/', [UserController::class, 'register'])->name('user.register');

// ユーザー登録処理
Route::post('/users/register/complete/', [UserController::class, 'complete'])->name('user.complete');

// ログイン画面
Route::get('/users/login/', [LoginController::class, 'login'])->name('user.login');

// ログイン処理
Route::post('/users/authenticate/', [LoginController::class, 'authenticate'])->name('user.authenticate');

// プロフィール画面
Route::get('/profiles/{userName}/', [ProfileController::class, 'show'])->name('profile.show');
