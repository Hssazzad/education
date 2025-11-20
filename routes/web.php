<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [PostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function () {
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});


// Admin Product Routes (full CRUD)
Route::prefix('admin')->middleware('auth')->group(function () {
    // List products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Create product
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Edit/update product
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    // Delete product
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Product Card Page (public)
Route::get('/cards', [ProductController::class, 'cards'])->name('products.cards');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
require __DIR__.'/auth.php';
