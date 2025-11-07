<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    // Nama tabel.
    protected $table = 'saldo';

    // Nonaktifkan mass assignment.
    protected $guarded = [];

    // Relasi one-to-one ke model Transaksi.
    public function transaksi()
    {
        return $this->hasOne('App\Models\Transaksi');
    }
}
