<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Category Routes
    Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('daftarCategory');
    Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('createCategory');
    Route::post('/category/create', [App\Http\Controllers\CategoryController::class, 'store'])->name('storeCategory');
    Route::get('/category/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('editCategory');
    Route::post('/category/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('updateCategory');
    Route::get('/category/{id}/delete', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('deleteCategory');

    // Product Routes
    Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('daftarProduct');
    Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('createProduct');
    Route::post('/product/create', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct');
    Route::get('/product/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct');
    Route::post('/product/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct');
    Route::get('/product/{id}/delete', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteProduct');

    // Transaction Routes
    Route::get('/transaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('daftarTransaction');
    Route::get('/transaction/create', [App\Http\Controllers\TransactionController::class, 'create'])->name('createTransaction');
    Route::post('/transaction/create', [App\Http\Controllers\TransactionController::class, 'store'])->name('storeTransaction');
    Route::get('/transaction/{id}/edit', [App\Http\Controllers\TransactionController::class, 'edit'])->name('editTransaction');
    Route::post('/transaction/{id}', [App\Http\Controllers\TransactionController::class, 'update'])->name('updateTransaction');
    Route::get('/transaction/{id}/delete', [App\Http\Controllers\TransactionController::class, 'destroy'])->name('deleteTransaction');
});
