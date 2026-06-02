<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products/new', [ProductsController::class, 'create']);
    Route::post('/products/new', [ProductsController::class, 'store']);

    Route::get('/products', [ProductsController::class, 'index']);

    Route::get('/products/update/{id}', [ProductsController::class, 'edit']);
    Route::post('/products/update/', [ProductsController::class, 'update']);

    Route::get('/products/delete/{id}', [ProductsController::class, 'destroy']);
});

require __DIR__ . '/auth.php';
