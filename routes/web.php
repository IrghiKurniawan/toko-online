<?php

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });

// Customer Routes ✅✅✅
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
        Route::get('/product', [ProductController::class, 'index'])->name('product');
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::patch('/cart/{cartItem}/increase', [CartController::class, 'increase'])->name('cart.increase');
        Route::patch('/cart/{cartItem}/decrease', [CartController::class, 'decrease'])->name('cart.decrease');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('loginProcess');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register-user', [UserController::class, 'register_user'])->name('registerUser');
});
