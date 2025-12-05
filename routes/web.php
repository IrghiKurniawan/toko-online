<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\UserController::class, 'login'])->name('loginProcess');
Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\UserController::class, 'register'])->name('register');
Route::post('/register-user', [App\Http\Controllers\UserController::class, 'register_user'])->name('registerUser');
