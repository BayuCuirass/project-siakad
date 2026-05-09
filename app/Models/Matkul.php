<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkuls';
    protected $fillable = ['kode_matkul', 'nama_matkul', 'sks'];

    // Relasi balik (Satu matkul bisa ada di banyak plotting)
    public function pengampus() {
        return $this->hasMany(Pengampu::class);
    }
}