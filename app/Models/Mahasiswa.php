<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    
    // Pastikan dosen_id ditambahkan di sini ya!
    protected $fillable = [
    'nim',
    'nama',
    'prodi',        // <-- Ganti id_prodi jadi prodi
    'status_aktif', 
    'dosen_id'
];

    // Relasi ke Dosen Wali (Belongs To)
    // "Setiap Mahasiswa memiliki satu Dosen Wali"
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}