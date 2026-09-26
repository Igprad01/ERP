<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::redirect('/', 'login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard.index')->name('dashboard');
});

require __DIR__ . '/settings.php';


route::get('/category', [CategoryController::class, 'index'])->name('category');
