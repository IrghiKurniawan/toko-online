<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

/*
| Dashboard Route
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');
/*
| Product Routes
*/
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/{cartItem}/increase', [CartController::class, 'increase'])->name('cart.increase');
    Route::patch('/cart/{cartItem}/decrease', [CartController::class, 'decrease'])->name('cart.decrease');


    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])
        ->name('orders.index');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
/*
| Authentication Routes
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('loginProcess');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register-user', [UserController::class, 'register_user'])->name('registerUser');
});
