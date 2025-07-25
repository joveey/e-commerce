<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing
Route::get('/', [ProductController::class, 'landing'])->name('landing');

// Produk berdasarkan kategori (pakai id)
Route::get('/kategori/{id}', [ProductController::class, 'byCategory'])->name('products.byCategory');

// Produk detail untuk user biasa
Route::get('/products/{id}', [ProductController::class, 'show'])->name('user.products.show');

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
    Route::patch('/cart/update-ajax/{id}', [CartController::class, 'updateAjax'])->name('cart.updateAjax');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout/product/{id}', [CartController::class, 'checkoutSingle'])->name('cart.checkout.single');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

});

// Admin Routes (resource) — pakai prefix dan alias khusus agar tidak tabrakan
Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminDashboardController::class, 'orders'])->name('orders');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::resource('products', AdminProductController::class)->names([
        'index'   => 'products.index',
        'create'  => 'products.create',
        'store'   => 'products.store',
        'show'    => 'products.show',
        'edit'    => 'products.edit',
        'update'  => 'products.update',
        'destroy' => 'products.destroy',
    ]);
});

require __DIR__.'/auth.php';
