<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

Route::get('/posts', [PostController::class, 'index'])->name('post');
Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::get('/posts/complete', [PostController::class, 'complete'])->name('post.complete');
Route::post('/posts/confirm', [PostController::class, 'confirm'])->name('post.confirm');

Route::get('/user/regist', [UserController::class, 'regist'])->name('user.regist');
Route::post('/user/regist/complete', [UserController::class, 'complete'])->name('user.complete');
Route::get('/user/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/user/logout', [LogoutController::class, 'logout'])->name('user.logout');
Route::post('/user/authenticate', [LoginController::class, 'authenticate'])->name('user.authenticate');