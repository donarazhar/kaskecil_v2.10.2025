<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Authenticatable
{
    // Traits untuk API, factory, dan notifikasi.
    use HasApiTokens, HasFactory, Notifiable;

    // Nama tabel.
    protected $table = "karyawan";
    // Kunci utama tabel.
    protected $primaryKey = "nik";

    // Atribut yang bisa diisi.
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jabatan',
        'no_hp',
        'password',
    ];

    // Atribut yang disembunyikan.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //Atribut yang harus di-cast.
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
