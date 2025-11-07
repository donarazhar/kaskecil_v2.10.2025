<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    // Menentukan nama tabel yang digunakan oleh model ini.
    protected $table = 'instansi';

    // Menonaktifkan perlindungan mass assignment.
    protected $guarded = [];
}
