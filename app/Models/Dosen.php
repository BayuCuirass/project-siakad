<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    // Connect ke SIMPEG
    protected $connection = 'simpeg';
    protected $table = 'pegawai';
    protected $primaryKey = 'nip';
    public $incrementing = false; // Karena nip string
    protected $keyType = 'string';

    protected $fillable = ['nip', 'nama', 'jenis_pegawai', 'status_kepegawaian', 'unit_kerja'];

    // Scope untuk dosen
    public function scopeDosen($query)
    {
        return $query->where('jenis_pegawai', 'like', '%Dosen%');
    }

    public function pengampus() {
        return $this->hasMany(Pengampu::class, 'dosen_id', 'nip');
    }

    // Untuk mahasiswa
    public function mahasiswas() {
        return $this->hasMany(Mahasiswa::class, 'dosen_id', 'nip');
    }
}