<?php

use App\Http\Controllers\GudangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StokGabahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// CRUD utama
Route::resource('jadwal', JadwalController::class);
Route::resource('stok-gabah', StokGabahController::class);

// Update status jadwal (terima, tolak, selesai)
Route::put('/jadwal/{id}/status', [JadwalController::class, 'updateStatus'])->name('jadwal.updateStatus');

// CRUD dengan middleware
Route::resource('gudang', GudangController::class)
    ->middleware(['auth', 'can:CRUD-gudang']);

Route::resource('stok-gabah', StokGabahController::class)
    ->middleware(['auth', 'can:create-stok', 'can:update-stok', 'can:delete-stok']);

Route::resource('role-manage', RoleController::class)
    ->middleware(['auth', 'can:CRUD-role']);

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
