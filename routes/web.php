<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PengampuController;

Route::get('/plotting', [PengampuController::class, 'index']);
Route::post('/plotting/simpan', [PengampuController::class, 'simpan']);
Route::post('/plotting/hapus/{id}', [PengampuController::class, 'hapus']);

// Route untuk fitur Plotting Dosen
Route::get('/plotting', [PengampuController::class, 'index']);
Route::post('/plotting/simpan', [PengampuController::class, 'simpan']);
Route::post('/plotting/hapus/{id}', [PengampuController::class, 'hapus']);

Route::get('/', function () {
    return view('dashboard');
});

// MAHASISWA
Route::get('/mahasiswa', [MahasiswaController::class, 'tampil']);
Route::post('/mahasiswa/simpan', [MahasiswaController::class, 'simpan']);

// EXPORT (PASTI JADI)
Route::get('/mahasiswa/pdf', [MahasiswaController::class, 'pdf']);
Route::get('/mahasiswa/excel', [MahasiswaController::class, 'excel']);
Route::get('/mahasiswa/csv', [MahasiswaController::class, 'csv']);

Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->whereNumber('id');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->whereNumber('id');
Route::delete('/mahasiswa/hapus/{id}', [MahasiswaController::class, 'hapus']);

// DOSEN
Route::get('/dosen', [DosenController::class, 'index']);