<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengampu extends Model
{
    // Kasih tau Laravel nama tabelnya (opsional kalau namanya udah pas, tapi buat jaga-jaga)
    protected $table = 'pengampus';
    
    protected $fillable = ['dosen_id', 'matkul_id', 'kelas'];

    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }

    public function matkul() {
        return $this->belongsTo(Matkul::class);
    }
}