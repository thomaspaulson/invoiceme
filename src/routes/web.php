<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SwaggerController;

Route::get('/', function () {
    return view('app');
});

// Swagger documentation routes
Route::get('/api-docs', [SwaggerController::class, 'index'])->name('swagger.index');
Route::get('/api-docs/spec', [SwaggerController::class, 'spec'])->name('swagger.spec');

Route::view('/{any}', 'app')->where('any', '.*');

