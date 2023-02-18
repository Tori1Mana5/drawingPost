<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/home', [HomeController::class, 'get']);
Route::post('/home', [HomeController::class, 'post']);

Route::get('/account/register', [UserController::class, 'get']);
Route::post('/account/register/confirm', [UserController::class, 'register']);
