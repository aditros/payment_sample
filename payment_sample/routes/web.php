<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/api-token', [ProfileController::class, 'updateApiToken'])->name('profile.api-token');
  
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/customer/create', [CustomerController::class, 'createIndex'])->name('customer.create.index');
    Route::post('/customer/create', [CustomerController::class, 'createPost'])->name('customer.create.post');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'editIndex'])->name('customer.edit.index');
    Route::patch('/customer/edit/{id}', [CustomerController::class, 'editPatch'])->name('customer.edit.patch');
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
    
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/create', [ProductController::class, 'createIndex'])->name('product.create.index');
    Route::post('/product/create', [ProductController::class, 'createPost'])->name('product.create.post');
    Route::get('/product/edit/{id}', [ProductController::class, 'editIndex'])->name('product.edit.index');
    Route::patch('/product/edit/{id}', [ProductController::class, 'editPatch'])->name('product.edit.patch');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
});

Route::prefix('api')->group(function () {
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    
    Route::get('/customers', [CustomerController::class, 'restAllCustomers'])->name('customers.rest');
    Route::get('/customers/{id}', [CustomerController::class, 'restCustomer'])->name('customer.rest');

    Route::get('/products', [ProductController::class, 'restAllProducts'])->name('products.rest');
    Route::get('/products/{id}', [ProductController::class, 'restProduct'])->name('product.rest');
});

require __DIR__.'/auth.php';
