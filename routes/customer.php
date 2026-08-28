<?php

use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [HomeController::class, 'index'])
    ->name('home');

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile');