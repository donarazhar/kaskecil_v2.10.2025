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
        Schema::create('akun_perkiraan', function (Blueprint $table) {
            $table->char('kode_perkiraan', 11)->primary();
            $table->string('nama_perkiraan', 50);
            $table->char('kode_kelompok', 11);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_perkiraan');
    }
};
