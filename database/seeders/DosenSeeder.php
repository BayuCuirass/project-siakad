<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        Dosen::create(['nidn' => '001', 'nama' => 'Budi', 'jabatan_akademik' => 'Lektor', 'status' => 'Aktif']);
        Dosen::create(['nidn' => '002', 'nama' => 'Andi', 'jabatan_akademik' => 'Asisten Ahli', 'status' => 'Aktif']);
        Dosen::create(['nidn' => '003', 'nama' => 'Siti', 'jabatan_akademik' => 'Lektor Kepala', 'status' => 'Aktif']);
    }
}