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
            // Cek dulu apakah kolom dosen_id sudah ada
            if (!Schema::hasColumn('mahasiswa', 'dosen_id')) {
                $table->bigInteger('dosen_id')->nullable()->after('prodi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            if (Schema::hasColumn('mahasiswa', 'dosen_id')) {
                $table->dropColumn('dosen_id');
            }
        });
    }
};
