<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('post');
Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::post('/posts/complete', [PostController::class, 'complete'])->name('post.complete');

