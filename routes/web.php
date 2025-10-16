<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\CartItemController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/products', [ProductAdminController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductAdminController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductAdminController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductAdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductAdminController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductAdminController::class, 'destroy'])->name('admin.products.destroy');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// 🧺 Routes du panier
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartItemController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartItemController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cartItem}', [CartItemController::class, 'destroy'])->name('cart.destroy');
});

// 🧾 Commandes
Route::middleware(['auth'])->group(function () {
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
});

// 🧰 Commandes admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/orders', [App\Http\Controllers\Admin\OrderAdminController::class, 'index'])->name('admin.orders.index');
    Route::put('/admin/orders/{order}/status', [App\Http\Controllers\Admin\OrderAdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});


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
});

require __DIR__.'/auth.php';
