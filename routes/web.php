<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'landing'])->name('landing');

// Produk detail untuk semua user (guest bisa lihat lalu diarahkan ke login)
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Authenticated + Verified users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/checkout/{product}', [ProductController::class, 'checkout'])->name('checkout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Profile & Cart untuk user login
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout/product/{id}', [CartController::class, 'checkoutSingle'])->name('cart.checkout.single');
});

// Admin Only
Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::resource('products', AdminProductController::class)->names('admin.products');
});

require __DIR__.'/auth.php';
