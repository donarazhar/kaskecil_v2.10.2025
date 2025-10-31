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
        Schema::create('akun_kelompok', function (Blueprint $table) {           
            $table->unsignedTinyInteger('kode_kelompok')->primary();
            $table->string('nama_kelompok', 50)->nullable();
            $table->tinyInteger('status_kelompok')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_kelompok');
    }
};
