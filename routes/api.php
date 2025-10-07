<?php

use Domain\Models\Invoice\InvoiceCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Infra\Controllers\RegisterController;
use Infra\Controllers\LoginController;
use Infra\Controllers\VendorController;
use Infra\Controllers\InvoiceController;
use Psr\EventDispatcher\EventDispatcherInterface;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/register', [RegisterController::class, 'index']);
// Route::post('/login', [LoginController::class, 'index']);
Route::resource('/vendor', VendorController::class);
Route::resource('/invoice', InvoiceController::class);


Route::get('/invoice/create', function (EventDispatcherInterface $dispatcher) {
    $event = new InvoiceCreated('1054');
    $dispatcher->dispatch($event);

    return '/invoice!';
});
