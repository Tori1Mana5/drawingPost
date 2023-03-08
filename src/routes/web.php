<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/posts', [PostController::class, 'index'])->name('post');
Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::post('/posts', [PostController::class, 'store'])->name('post.store');
Route::post('/posts/confirm', [PostController::class, 'confirm'])->name('post.confirm');

Route::get('/user/regist', [UserController::class, 'regist'])->name('user.regist');
Route::get('/user/regist/confirm', [UserController::class, 'confirm'])->name('user.confirm');
Route::get('/user/regist/complete', [UserController::class, 'complete'])->name('user.complete');
