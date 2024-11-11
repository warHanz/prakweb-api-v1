<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\MahasiswaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/mahasiswas', MahasiswaController::class);
Route::apiResource('/dosens', DosenController::class);
