<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::name('public.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::get('/order-confirmation', [HomeController::class, 'orderConfirmation'])->name('order.confirmation');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
// Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
// Route::get('/order-confirmation', [HomeController::class, 'orderConfirmation'])->name('order.confirmation');
// Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('products', ProductController::class);

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Categories Resource
    Route::resource('categories', CategoryController::class);
});

// Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');

//     Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');
//     Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
//     Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
//     Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
//     Route::put('products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
//     Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

//     Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
//     Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

//     Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
//     Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
//     Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
//     Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
// });

require __DIR__.'/auth.php';
