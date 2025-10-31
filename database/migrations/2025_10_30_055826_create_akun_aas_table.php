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
        Schema::create('akun_aas', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->primary(); // INT(2) mirip dengan unsignedSmallInteger
            $table->char('kode_aas', 25)->nullable();
            $table->string('nama_aas', 50)->nullable();
            $table->enum('status', ['d', 'k'])->nullable();
            $table->enum('kategori', ['pembentukan', 'pengisian', 'pengeluaran'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_aas');
    }
};
