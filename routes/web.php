<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\MasyarakatAuthController;
use App\Http\Controllers\Masyarakat\DataIrigasiController;
use App\Http\Controllers\Masyarakat\HomeController;
use App\Http\Controllers\Masyarakat\LaporanController;
use App\Http\Controllers\Masyarakat\PetaController;
use App\Http\Controllers\Masyarakat\ProfilController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataIrigasiController as AdminDataIrigasiController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\PetaController as AdminPetaController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/peta-interaktif', [PetaController::class, 'index'])->name('peta.index');
Route::get('/data-irigasi', [DataIrigasiController::class, 'index'])->name('data-irigasi.index');
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/form-laporan', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');

/*
|--------------------------------------------------------------------------
| MASYARAKAT AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [MasyarakatAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [MasyarakatAuthController::class, 'login']);

    Route::get('/register', [MasyarakatAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [MasyarakatAuthController::class, 'register']);
});

Route::post('/logout', [MasyarakatAuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:web');

/*
|--------------------------------------------------------------------------
| MASYARAKAT PROTECTED
|--------------------------------------------------------------------------
*/

Route::middleware('auth:web')->group(function () {
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');
});

/*
|--------------------------------------------------------------------------
| ADMIN AUTH (FIXED - IMPORTANT)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    // GUEST ADMIN
    Route::middleware('guest:admin')->group(function () {

        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
            ->name('admin.login.form');

        Route::post('/login', [AdminAuthController::class, 'login'])
            ->name('admin.login');
    });

    // LOGOUT ADMIN
    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Users
    Route::get('/users', [ManageUsersController::class, 'index'])
        ->name('admin.users.index');

    Route::post('/users/admin', [ManageUsersController::class, 'storeAdmin'])
        ->name('admin.users.admin.store');

    Route::delete('/users/admin/{id}', [ManageUsersController::class, 'destroyAdmin'])
        ->name('admin.users.admin.destroy');

    Route::delete('/users/masyarakat/{id}', [ManageUsersController::class, 'destroyMasyarakat'])
        ->name('admin.users.masyarakat.destroy');

    // Laporan
    Route::get('/laporan', [AdminLaporanController::class, 'index'])
        ->name('admin.laporan.index');

    Route::post('/laporan/{id}/verifikasi', [AdminLaporanController::class, 'verifikasi'])
        ->name('admin.laporan.verifikasi');

    Route::post('/laporan/{id}/proses', [AdminLaporanController::class, 'proses'])
        ->name('admin.laporan.proses');

    Route::post('/laporan/{id}/selesai', [AdminLaporanController::class, 'selesai'])
        ->name('admin.laporan.selesai');

    Route::post('/laporan/{id}/tolak', [AdminLaporanController::class, 'tolak'])
        ->name('admin.laporan.tolak');

    // Data Irigasi
    Route::get('/data-irigasi', [AdminDataIrigasiController::class, 'index'])
        ->name('admin.data-irigasi.index');

    Route::post('/data-irigasi', [AdminDataIrigasiController::class, 'store'])
        ->name('admin.data-irigasi.store');

    Route::put('/data-irigasi/{id}', [AdminDataIrigasiController::class, 'update'])
        ->name('admin.data-irigasi.update');

    Route::delete('/data-irigasi/{id}', [AdminDataIrigasiController::class, 'destroy'])
        ->name('admin.data-irigasi.destroy');

    // Peta
    Route::get('/peta-interaktif', [AdminPetaController::class, 'index'])
        ->name('admin.peta.index');

    // Profil
    Route::get('/profil', [AdminProfilController::class, 'index'])
        ->name('admin.profil');

    Route::put('/profil', [AdminProfilController::class, 'update'])
        ->name('admin.profil.update');

    Route::put('/profil/password', [AdminProfilController::class, 'updatePassword'])
        ->name('admin.profil.password');
});