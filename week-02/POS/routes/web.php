<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;

// 1. Halaman Home
Route::get('/', [HomeController::class, 'index']);

// 2. Halaman Products (Route Prefix)
Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [ProductController::class, 'foodBeverage']);
    Route::get('/beauty-health', [ProductController::class, 'beautyHealth']);
    Route::get('/home-care', [ProductController::class, 'homeCare']);
    Route::get('/baby-kid', [ProductController::class, 'babyKid']);
});

// 3. Halaman User (Route Param)
Route::get('/user', [UserController::class, 'index']);

// 4. Halaman Penjualan
Route::get('/sales', [SalesController::class, 'index']);

// 5. Halaman Level
Route::get('/level', [LevelController::class, 'index']);

// 6. Halaman Kategori
Route::get('/kategori', [KategoriController::class, 'index']);

// 7. Halaman Supplier
Route::get('/supplier', [SupplierController::class, 'index']);

// Route untuk nampilin form
Route::get('/user/tambah', [UserController::class, 'tambah']); 
// Route untuk memproses data dari form
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

// Route untuk menampilkan form ubah data
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// Route untuk memproses simpan perubahan data (pakai PUT)
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

// Route untuk menghapus data
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);