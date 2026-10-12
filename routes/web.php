<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Halaman admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Halaman Admin';
    })->name('admin.dashboard');
});

// Halaman editor
Route::middleware(['auth', 'role:admin,editor'])->group(function () {
    Route::get('/editor', function () {
        return 'Halaman Editor';
    })->name('editor.dashboard');
});

// Katalog produk (bisa dilihat tanpa login)
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

// Pengelolaan produk (harus login)
Route::middleware('auth')
    ->prefix('products')
    ->name('products.')
    ->group(function () {
        Route::get('/manage', [ProductController::class, 'manage'])
            ->name('manage');

        Route::get('/create', [ProductController::class, 'create'])
            ->name('create');

        Route::post('/', [ProductController::class, 'store'])
            ->name('store');

        Route::get('/{product}/edit', [ProductController::class, 'edit'])
            ->name('edit');

        Route::put('/{product}', [ProductController::class, 'update'])
            ->name('update');

        Route::delete('/{product}', [ProductController::class, 'destroy'])
            ->name('destroy');
    });

require __DIR__.'/auth.php';