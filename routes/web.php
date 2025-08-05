<?php

use Illuminate\Support\Facades\Route;
use Infra\Controllers\RegisterController;
use Infra\Controllers\LoginController;
use Infra\Controllers\VendorController;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/register', [RegisterController::class, 'index']);
// Route::post('/login', [LoginController::class, 'index']);
Route::resource('/vendor', VendorController::class);

