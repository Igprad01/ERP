<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tripadd', [TripController::class, 'store'])->name('trip.store');
Route::get('/tripView', [TripController::class, 'index'])->name('trip.index');
