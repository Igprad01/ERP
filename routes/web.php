<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\FinansialController;

Route::redirect('/', 'login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard.index')->name('dashboard');
});

require __DIR__ . '/settings.php';


// category
route::get('/category', [CategoryController::class, 'index'])->name('category');
route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

// transaksi trips dan daily activity

route::get('/trip', [TripController::class, 'index'])->name('trip');
route::get('/trip/tambah', [TripController::class, 'create'])->name('trip.tambah');
route::post('/trip/store', [TripController::class, 'store'])->name('trip.store');


// finansial
route::get('/finansial', [FinansialController::class, 'index'])->name('finansial');
route::get('/finansial/create', [FinansialController::class, 'create'])->name('finansial.create');
route::post('/finansial/store', [FinansialController::class, 'store'])->name('finansial.store');
route::get('/finansial/edit/{id}', [FinansialController::class, 'edit'])->name('finansial.edit');
route::put('/finansial/update/{id}', [FinansialController::class, 'update'])->name('finansial.update');
route::delete('/finansial/delete/{id}', [FinansialController::class, 'destroy'])->name('finansial.destroy');
