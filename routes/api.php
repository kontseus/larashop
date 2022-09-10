<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth', \App\Http\Controllers\Api\AuthController::class)->name('auth');

Route::namespace('v1')->prefix('v1')->group(function() {
    Route::get('products', [\App\Http\Controllers\Api\ProductsController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('products/{product}', [\App\Http\Controllers\Api\ProductsController::class, 'show']);
    });
});
