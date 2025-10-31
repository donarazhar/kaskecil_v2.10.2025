<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AkunKelompok; // Sesuaikan jika nama Model Anda berbeda

class AkunKelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data yang akan dimasukkan
        $data = [
            [
                'kode_kelompok' => 1,
                'nama_kelompok' => 'Aktiva Lancar',
                'status_kelompok' => 1,
            ],
            [
                'kode_kelompok' => 2,
                'nama_kelompok' => 'Aktiva Tetap',
                'status_kelompok' => 1,
            ],
        ];

        // Memasukkan data ke tabel 'akun_kelompok'
        DB::table('akun_kelompok')->insert($data);
    }
}
