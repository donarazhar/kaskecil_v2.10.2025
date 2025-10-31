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
        Schema::create('akun_matanggaran', function (Blueprint $table) {            
            $table->unsignedTinyInteger('id')->primary();
            $table->string('kode_matanggaran', 25)->nullable();
            $table->char('kode_aas', 11)->nullable();
            $table->integer('saldo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_matanggaran');
    }
};
