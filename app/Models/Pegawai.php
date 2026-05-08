<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    // Ini kode rahasia agar dia mencari ke database simpeg!
    protected $connection = 'simpeg'; 
    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nip', 'nama', 'jenis_pegawai', 'status_kepegawaian', 'unit_kerja'
    ];
}