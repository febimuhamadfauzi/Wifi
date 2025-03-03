<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ArticleController;

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware Admin (Hanya Admin yang Bisa Akses)
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin (Langsung ke sini setelah login)
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // API untuk update total produk otomatis
    Route::get('/admin/total-products', [AdminController::class, 'getTotalProducts'])->name('admin.total-products');

    // CRUD Produk
    Route::resource('products', ProductController::class);

    // CRUD Artikel
    Route::resource('articles', ArticleController::class);
});
