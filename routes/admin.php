<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MoodController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('moods', MoodController::class);