<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Dosen::insert([
        ['nidn' => '00112233', 'nama_dosen' => 'Marta Ardiyanto, S.Kom, M.Kom', 'spesialisasi' => 'INTEGRASI APLIKASI KORPORASI '],
        ['nidn' => '44556677', 'nama_dosen' => 'EKO PURWANTO, M.Kom., Ph.D', 'spesialisasi' => 'PERENCANAAN STRATEGI SI/TI'],
        ['nidn' => '88990011', 'nama_dosen' => 'Togay', 'spesialisasi' => 'Programming'],
        ['nidn' => '22334455', 'nama_dosen' => 'SUNDARI, SE., MM', 'spesialisasi' => 'Kewirausahaan'],
    ]);
}
}
