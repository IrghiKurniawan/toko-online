<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// controllers admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
// controllers customer

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProductController;

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Category Routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    // Product Routes
    Route::get('/product', [ProductAdminController::class, 'adminIndex'])->name('product');
    Route::get('/product/create', [ProductAdminController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductAdminController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductAdminController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductAdminController::class, 'update'])->name('product.update');
    Route::delete('/product/destroy/{id}', [ProductAdminController::class, 'destroy'])->name('product.destroy');
    // Order Routes
    Route::get('/orders', [OrderAdminController::class, 'index'])->name('orders');
    Route::put('/orders/update/{id}', [OrderAdminController::class, 'updateStatus'])->name('orders.update');


    // Logout Route
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

// Customer Routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/orders', [OrderController::class, 'index'])->name('order');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::patch('/cart/{cartItem}/increase', [CartController::class, 'increase'])->name('cart.increase');
    Route::patch('/cart/{cartItem}/decrease', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register-user', [UserController::class, 'register_user'])->name('registerUser');
});

// login page
Route::get('/', [UserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->name('loginProcess');

// Redirect setelah login
Route::get('/home', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('customer.product');
})->middleware('auth')->name('home');
