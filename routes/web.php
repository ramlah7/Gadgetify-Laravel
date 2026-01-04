<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
});

// Customer Routes
Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'addItem'])->name('cart.add');
    Route::delete('/cart/remove/{cartItem}', [\App\Http\Controllers\CartController::class, 'removeItem'])->name('cart.remove');
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'processOrder'])->name('checkout.process');
    Route::get('/orders/history', [\App\Http\Controllers\OrderController::class, 'history'])->name('orders.history');
});
