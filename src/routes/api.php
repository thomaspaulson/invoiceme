<?php

use Domain\Models\Invoice\InvoiceCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientController;
use Psr\EventDispatcher\EventDispatcherInterface;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    // logout
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete(); // Revoke the current token
        return response()->noContent();
    });
});
Route::post('/register', [RegisterController::class, 'index']);
Route::post('/login', [LoginController::class, 'index']);
Route::resource('/vendor', VendorController::class);
Route::resource('/invoice', InvoiceController::class);
Route::apiResource('/client', ClientController::class);


Route::get('/invoice/create', function (EventDispatcherInterface $dispatcher) {
    $event = new InvoiceCreated('1054');
    $dispatcher->dispatch($event);

    return '/invoice!';
});
