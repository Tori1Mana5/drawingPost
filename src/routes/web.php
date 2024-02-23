<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

// ログインした後に許可する
Route::middleware(['can:isLogin'])->group(function () {
    Route::get('/posts/store/', [PostController::class, 'store'])->name('post.store');
    Route::post('/posts/store/complete/', [PostController::class, 'storeComplete'])->name('post.store.complete');
    Route::get('/posts/edit/{postId}/', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/posts/edit/{postId}/complete/', [PostController::class, 'editComplete'])->name('post.edit.complete');
    Route::get('/users/logout/', [LogoutController::class, 'logout'])->name('user.logout');
    Route::get('/profiles/{userName}/register/', [ProfileController::class, 'register'])->name('profile.register');
    Route::post('/profiles/{userName}/register/complete/', [ProfileController::class, 'registerComplete'])->name('profile.register.complete');
    Route::get('/profiles/{userName}/edit/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profiles/{userName}/edit/complete/', [ProfileController::class, 'editComplete'])->name('profile.edit.complete');
});
Route::get('/posts/', [PostController::class, 'index'])->name('post');
Route::get('/users/register/', [UserController::class, 'register'])->name('user.register');
Route::post('/users/register/complete/', [UserController::class, 'complete'])->name('user.complete');
Route::get('/users/login/', [LoginController::class, 'login'])->name('user.login');
Route::post('/users/authenticate/', [LoginController::class, 'authenticate'])->name('user.authenticate');
Route::get('/profiles/{userName}/', [ProfileController::class, 'show'])->name('profile.show');
