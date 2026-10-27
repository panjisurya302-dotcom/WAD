<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HousekeeperController;

// Mengarahkan halaman utama ke modul housekeepers
Route::get('/', function () {
    return redirect()->route('housekeepers.index');
});

// Resource Route untuk CRUD Housekeeper[cite: 1]
Route::resource('housekeepers', HousekeeperController::class);