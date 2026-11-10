<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HousekeeperController;
use App\Http\Controllers\AuthController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('housekeepers.index');
});

// Route Autentikasi Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route CRUD Housekeeper yang diamankan dengan Middleware Auth
Route::middleware(['auth'])->group(function () {
    Route::resource('housekeepers', HousekeeperController::class);
});