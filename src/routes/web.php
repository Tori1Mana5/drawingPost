<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

// ログインした後に許可する
Route::middleware(['can:isLogin'])->group(function () {
    Route::get('/posts/create/', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts/complete/', [PostController::class, 'complete'])->name('post.complete');
    Route::get('/users/logout/', [LogoutController::class, 'logout'])->name('user.logout');
    Route::get('/profiles/{userName}/register/', [ProfileController::class, 'register'])->name('profile.register');
    Route::post('/profiles/{userName}/register/complete/', [ProfileController::class, 'storeComplete'])->name('profile.register.complete');
    Route::get('/profiles/{userName}/edit/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profiles/{userName}/edit/complete/', [ProfileController::class, 'editComplete'])->name('profile.edit.complete');
});
Route::get('/posts/', [PostController::class, 'index'])->name('post');
Route::get('/users/register/', [UserController::class, 'register'])->name('user.register');
Route::post('/users/register/complete/', [UserController::class, 'complete'])->name('user.complete');
Route::get('/users/login/', [LoginController::class, 'login'])->name('user.login');
Route::post('/users/authenticate/', [LoginController::class, 'authenticate'])->name('user.authenticate');
Route::get('/profiles/{userName}/', [ProfileController::class, 'show'])->name('profile.show');
