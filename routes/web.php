<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*Route::prefix('posts')->name('posts')->groupe(function(){
    Route::get('/', [App\Http\Controllers\Controller::class, 'index']);
    Route::post('/', [App\Http\Controllers\Controller::class, 'store'])->name('.store');
    Route::get('create', [App\Http\Controllers\Controller::class], 'index')->name('.create');
    Route::get('{post}/edit', [App\Http\Controllers\Controller::class], 'index')->name('.update');
});*/

