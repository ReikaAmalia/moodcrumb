<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(base_path('routes/admin.php'));

Route::middleware(['auth', 'customer'])
    ->name('customer.')
    ->group(base_path('routes/customer.php'));