<?php

use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile');