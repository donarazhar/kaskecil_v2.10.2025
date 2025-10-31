<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use App\Models\Instansi; // Tidak perlu jika menggunakan DB::table

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data yang akan dimasukkan
        $data = [
            [
                'id' => 1,
                'nama' => 'Masjid Agung Al Azhar',
                'alamat' => 'Jl. Sisingamangaraja, Kebayoran Baru, Jakarta Selatan.',
                'created_at' => '2023-12-28 12:17:58',
                'updated_at' => '2024-01-03 03:53:19',
                'pimpinan' => 'H. Tatang Komara',
            ],
        ];

        // Memasukkan data ke tabel 'instansi'
        DB::table('instansi')->insert($data);
    }
}
