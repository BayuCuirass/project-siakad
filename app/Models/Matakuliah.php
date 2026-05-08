<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $fillable = ['kode_mk', 'nama_mk', 'sks'];

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'dosen_matakuliah');
    }
}