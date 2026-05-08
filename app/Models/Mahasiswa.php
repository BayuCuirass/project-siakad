<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    
    protected $fillable = [
        'nim',
        'nama',
        'id_prodi',
        'status_aktif'
    ];
}