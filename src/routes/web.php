<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/home', [HomeController::class, 'get']);
Route::post('/home', [HomeController::class, 'post']);
