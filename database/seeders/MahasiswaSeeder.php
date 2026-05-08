<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::create(['nim'=>'123456', 'nama'=>'Andi Saputra', 'prodi'=>'Informatika', 'dosen_wali_id'=>1, 'status_aktif'=>1]);
        Mahasiswa::create(['nim'=>'123457', 'nama'=>'Budi Prasetyo', 'prodi'=>'Sistem Informasi', 'dosen_wali_id'=>1, 'status_aktif'=>1]);
        Mahasiswa::create(['nim'=>'123458', 'nama'=>'Citra Dewi', 'prodi'=>'Informatika', 'dosen_wali_id'=>2, 'status_aktif'=>1]);
        Mahasiswa::create(['nim'=>'123459', 'nama'=>'Dian Permata', 'prodi'=>'Teknik Komputer', 'dosen_wali_id'=>2, 'status_aktif'=>1]);
    }
}