<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\HomepageController;

Route::get('/', function () {
    return view('frontend.index');
});

// Route::get('index', [DashboardController::class, 'index'])->name('index');
// Route::get('index', [HomepageController::class, 'index'])->name('index');
