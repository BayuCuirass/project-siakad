<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengampu extends Model
{
    protected $table = 'pengampus'; 

    // WAJIB ADA: Izin biar form web bisa nyimpen ke database
    protected $fillable = [
        'dosen_id',
        'matkul_id',
        'kelas'
    ];

    // Relasi ke Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    // Relasi ke Matkul
    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'matkul_id');
    }
}