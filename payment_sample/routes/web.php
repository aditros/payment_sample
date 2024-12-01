<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

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
    Route::patch('/profile/api-token', [ProfileController::class, 'updateApiToken'])->name('profile.api-token');
  
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/customer/create', [CustomerController::class, 'createIndex'])->name('customer.create.index');
    Route::post('/customer/create', [CustomerController::class, 'createPost'])->name('customer.create.post');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'editIndex'])->name('customer.edit.index');
    Route::patch('/customer/edit/{id}', [CustomerController::class, 'editPatch'])->name('customer.edit.patch');
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
});

require __DIR__.'/auth.php';
