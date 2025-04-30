<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Semua route di bawah ini butuh login + verifikasi email
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard pakai controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (edit/update/destroy)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Role (semua user login)
    Route::resource('roles', RoleController::class);

    // CRUD User (hanya Administrator)
    Route::middleware(CheckRole::class . ':Administrator')->group(function () {
        Route::resource('users', UserController::class);
    });

    // CRUD Category
    Route::resource('categories', CategoryController::class);

    // CRUD Product
    Route::resource('products', ProductController::class);

    // CRUD Transaction
    Route::resource('transactions', TransactionController::class);

    // Audit Trail
    Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');

    // Export Import Product
    Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
    Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
});

require __DIR__.'/auth.php';
