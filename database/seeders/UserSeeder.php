<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan Anda mengimpor Model User

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Password: admin123 akan di-hash menggunakan bcrypt
        $hashedPassword = Hash::make('admin123');

        // Data User
        $userData = [
            'name' => 'Donar Azhar',
            'email' => 'donarazhar@gmail.com',
            'password' => $hashedPassword,
            // Asumsi kolom 'level' ada di tabel 'users'
            'level' => 'admin',
            'created_at' => now(), // Tambahkan timestamp Laravel
            'updated_at' => now(), // Tambahkan timestamp Laravel
        ];

        // Memasukkan data ke tabel 'users'
        // Disarankan menggunakan Model Eloquent (User::create) atau Query Builder (DB::table)
        DB::table('users')->insert($userData);
    }
}
