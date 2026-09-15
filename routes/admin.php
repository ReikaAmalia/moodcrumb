<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MoodController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('moods', MoodController::class);

Route::resource('products', ProductController::class)
    ->except(['show']);