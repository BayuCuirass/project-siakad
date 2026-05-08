<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        Matakuliah::create(['kode_mk' => 'MK001', 'nama_mk' => 'Pemrograman Web', 'sks' => 3]);
        Matakuliah::create(['kode_mk' => 'MK002', 'nama_mk' => 'Cloud Computing', 'sks' => 3]);
        Matakuliah::create(['kode_mk' => 'MK003', 'nama_mk' => 'Basis Data', 'sks' => 3]);
        Matakuliah::create(['kode_mk' => 'MK004', 'nama_mk' => 'Jaringan Komputer', 'sks' => 2]);
    }
}