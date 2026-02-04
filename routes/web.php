<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function(){
        Route::resource('kategori', KategoriController::class);
        Route::resource('alat', AlatController::class);
        Route::resource('users', UserController::class);
        Route::get('log-aktivitas', [LogController::class,'index']);
    });

    Route::middleware('role:petugas')->group(function(){
        Route::get('peminjaman', [PeminjamanController::class,'index']);
        Route::post('peminjaman/{id}/kembali', [PeminjamanController::class,'kembali']);
    });

    Route::middleware('role:peminjam')->group(function(){
        Route::get('daftar-alat', [AlatController::class,'list']);
        Route::post('pinjam/{id}', [PeminjamanController::class,'pinjam']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
