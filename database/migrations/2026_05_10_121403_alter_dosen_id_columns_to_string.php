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
            $table->string('dosen_id')->nullable()->change();
        });

        Schema::table('pengampus', function (Blueprint $table) {
            $table->string('dosen_id')->change();
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->bigInteger('dosen_id')->nullable()->change();
        });

        Schema::table('pengampus', function (Blueprint $table) {
            $table->bigInteger('dosen_id')->change();
        });
    }
};
