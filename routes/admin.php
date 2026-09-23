<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MoodController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('moods', MoodController::class);

Route::resource('products', ProductController::class)
    ->except(['show']);

Route::prefix('stock')->name('stock.')->group(function () {
    Route::get('/', [StockController::class, 'index'])->name('index');
    Route::get('/history', [StockController::class, 'history'])->name('history');
    Route::post('/{product}/add', [StockController::class, 'addStock'])->name('add');
    Route::post('/{product}/deduct', [StockController::class, 'deductStock'])->name('deduct');
});