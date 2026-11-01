<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProcurementPackageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama & Redirect
Route::get('/', fn () => redirect()->route('login'));
Route::get('/home', fn () => redirect()->route('dashboard'));

// Rute Tamu (Belum Login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

// Logout (Harus Auth)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Rute Terproteksi (Harus Login)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Ekspor Excel & PDF (Admin & Petugas)
    Route::middleware(['role:ADMIN,PETUGAS'])->group(function () {
        Route::get('/dashboard/export/excel', [DashboardController::class, 'exportExcel'])->name('dashboard.export.excel');
        Route::get('/dashboard/export/pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.export.pdf');
    });

    // Manajemen Pengguna (User) - Admin
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Manajemen Paket Pengadaan
    Route::get('/packages/create', [ProcurementPackageController::class, 'create'])->name('packages.create');
    Route::post('/packages', [ProcurementPackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{id}/edit', [ProcurementPackageController::class, 'edit'])->name('packages.edit');
    Route::put('/packages/{id}', [ProcurementPackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{id}', [ProcurementPackageController::class, 'destroy'])->name('packages.destroy');

});