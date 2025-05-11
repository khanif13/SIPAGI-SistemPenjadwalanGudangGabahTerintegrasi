<?php

use App\Http\Controllers\GudangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StokGabahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/faq', function () {
    return view('faq');
});

// CRUD utama
Route::resource('jadwal', JadwalController::class);
Route::resource('stok-gabah', StokGabahController::class);

// Update status jadwal (terima, tolak, selesai)
Route::put('/jadwal/{id}/status', [JadwalController::class, 'updateStatus'])->name('jadwal.updateStatus');

// CRUD dengan middleware
Route::resource('gudang', GudangController::class)
    ->middleware(['auth', 'can:create-gudang', 'can:delete-gudang']);

Route::resource('gudang', GudangController::class)
    ->middleware(['auth', 'can:update-gudang']);

// Form assign manager ke gudang
Route::get('/gudang/{id}/assign-manager', [GudangController::class, 'assignManagerForm'])->name('gudang.assign.form');

// Proses assign manager
Route::post('/gudang/{id}/assign-manager', [GudangController::class, 'assignManager'])->name('gudang.assign');

Route::resource('stok-gabah', StokGabahController::class)
    ->middleware(['auth', 'can:CRUD-stok']);

Route::resource('role-manage', RoleController::class)
    ->middleware(['auth', 'can:CRUD-role']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
