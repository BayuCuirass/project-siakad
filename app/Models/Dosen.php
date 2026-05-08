<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    
    protected $table = 'dosen';
    
    protected $fillable = ['nidn', 'nama', 'jabatan_akademik', 'status'];
    
    // Relasi ke Mahasiswa (sebagai dosen wali)
    public function mahasiswaWali()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_wali_id');
    }
    public function matakuliah()
{
    return $this->belongsToMany(Matakuliah::class, 'dosen_matakuliah');
}
}