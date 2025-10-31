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
        Schema::create('transaksi_shadow', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('perincian', 255)->nullable();
            $table->integer('jumlah')->nullable(); // int(11)
            $table->integer('id_pengisian')->nullable(); // int(11)
            $table->enum('kategori', ['pembentukan', 'pengeluaran', 'pengisian'])->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();
            $table->string('kode_matanggaran', 11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_shadow');
    }
};
