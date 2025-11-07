<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Traits untuk API, factory, dan notifikasi.
    use HasApiTokens, HasFactory, Notifiable;


    // Menentukan nama tabel.
    protected $table = 'users';

    // Atribut yang bisa diisi.
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
    ];

    // Atribut yang disembunyikan.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting tipe data atribut.
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
