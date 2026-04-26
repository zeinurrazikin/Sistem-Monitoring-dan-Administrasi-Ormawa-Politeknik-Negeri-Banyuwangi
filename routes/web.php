<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route Dashboard standar yang diarahkan ke Administrasi
Route::get('/dashboard', function () {
    return redirect()->route('administrasi.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // 1. Halaman Tabel Monitoring (Administrasi)
    Route::get('/administrasi', [AdministrationController::class, 'index'])->name('administrasi.index');
    
    // 2. Halaman Form Pengajuan
    Route::get('/administrasi/create', [AdministrationController::class, 'create'])->name('administrasi.create');
    
    // 3. Proses Simpan ke Database
    Route::post('/administrasi/store', [AdministrationController::class, 'store'])->name('administrasi.store');
    
    // 4. Proses Update Revisi
    Route::post('/administrasi/{id}/revision', [AdministrationController::class, 'updateRevision'])->name('administrasi.updateRevision');
    
    // 5. Proses Hapus
    Route::delete('/administrasi/{id}', [AdministrationController::class, 'destroy'])->name('administrasi.destroy');

    // Profile Routes (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
