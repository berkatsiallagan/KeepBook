<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Buku Routes
    Route::prefix('buku')->name('buku.')->group(function () {
        Route::get('/', [AdminController::class, 'bukuIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'bukuCreate'])->name('create');
        Route::post('/', [AdminController::class, 'bukuStore'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'bukuEdit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'bukuUpdate'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'bukuDestroy'])->name('destroy');
    });
    
    // Peminjaman Routes
    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
        Route::get('/', [AdminController::class, 'peminjamanIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'peminjamanCreate'])->name('create');
        Route::post('/', [AdminController::class, 'peminjamanStore'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'peminjamanEdit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'peminjamanUpdate'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'peminjamanDestroy'])->name('destroy');
        Route::put('/{peminjaman}/kembalikan', [AdminController::class, 'kembalikan'])->name('kembalikan');
    });
    
    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [AdminController::class, 'userIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'userCreate'])->name('create');
        Route::post('/', [AdminController::class, 'userStore'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'userEdit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'userUpdate'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'userDestroy'])->name('destroy');
    });
});

// Client Routes
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    Route::post('/pinjam', [ClientController::class, 'pinjamBuku'])->name('pinjam');
});

// Redirect root to login
Route::redirect('/', '/login');