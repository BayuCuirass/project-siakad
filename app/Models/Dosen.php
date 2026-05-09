<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    // Kalau mau ditulis, pastikan pakai 's'
    protected $table = 'dosens'; 
    
    protected $fillable = ['nidn', 'nama_dosen', 'spesialisasi', 'status_aktif'];

    public function pengampus() {
        return $this->hasMany(Pengampu::class);
    }
}