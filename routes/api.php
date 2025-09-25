<?php

use Domain\Models\Invoice\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Infra\Controllers\RegisterController;
use Infra\Controllers\LoginController;
use Infra\Controllers\VendorController;
use Infra\Controllers\InvoiceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/register', [RegisterController::class, 'index']);
// Route::post('/login', [LoginController::class, 'index']);
Route::resource('/vendor', VendorController::class);
Route::resource('/invoice', InvoiceController::class);
