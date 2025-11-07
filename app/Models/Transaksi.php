<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Nama tabel.
    protected $table = 'transaksi';

    // Nonaktifkan mass assignment.
    protected $guarded = [];

    // Atribut yang akan di-cast ke Carbon instances.
    protected $dates = ['tanggal'];


    // Relasi many-to-one ke model Saldo.
    public function saldo()
    {
        return $this->belongsTo('App\Models\Saldo');
    }
}
