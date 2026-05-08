<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('dosen_wali_id')->nullable()->after('prodi');
            $table->foreign('dosen_wali_id')
                  ->references('id')
                  ->on('dosen')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['dosen_wali_id']);
            $table->dropColumn('dosen_wali_id');
        });
    }
};