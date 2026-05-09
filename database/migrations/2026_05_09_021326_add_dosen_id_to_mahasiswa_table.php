<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('mahasiswa', function (Blueprint $table) {
        // Menambahkan kolom dosen_id (Foreign Key) setelah kolom prodi
        // Kita pakai bigInteger karena tabel dosens pakai bigint
        // Kita kasih nullable() karena mungkin ada mahasiswa baru yang belum dapet dosen wali
        $table->bigInteger('dosen_id')->nullable()->after('prodi');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            //
        });
    }
};
