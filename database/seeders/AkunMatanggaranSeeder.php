<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AkunMatanggaran; // Sesuaikan jika nama Model Anda berbeda

class AkunMatanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data yang akan dimasukkan
        $data = [
            [
                'id' => 2,
                'kode_matanggaran' => '2.1.14',
                'kode_aas' => '5010001504',
                'saldo' => 21542812,
            ],
            [
                'id' => 3,
                'kode_matanggaran' => '2.1.16',
                'kode_aas' => '5010001506',
                'saldo' => 15000000,
            ],
            [
                'id' => 4,
                'kode_matanggaran' => '2.1.17',
                'kode_aas' => '5010001507',
                'saldo' => 2000000,
            ],
            [
                'id' => 5,
                'kode_matanggaran' => '2.1.22',
                'kode_aas' => '5010002502',
                'saldo' => 12000000,
            ],
            [
                'id' => 6,
                'kode_matanggaran' => '2.2.24',
                'kode_aas' => '5010002504',
                'saldo' => 360000000,
            ],
            [
                'id' => 7,
                'kode_matanggaran' => '2.2.26',
                'kode_aas' => '5010002506',
                'saldo' => 17000000,
            ],
            [
                'id' => 8,
                'kode_matanggaran' => '2.2.27',
                'kode_aas' => '5010002507',
                'saldo' => 15000000,
            ],
            [
                'id' => 9,
                'kode_matanggaran' => '2.2.28',
                'kode_aas' => '5010002508',
                'saldo' => 30000000,
            ],
            [
                'id' => 10,
                'kode_matanggaran' => '2.2.11',
                'kode_aas' => '5010002512',
                'saldo' => 5000000,
            ],
            [
                'id' => 12,
                'kode_matanggaran' => '2.2.15',
                'kode_aas' => '5010003505',
                'saldo' => 16000000,
            ],
            [
                'id' => 13,
                'kode_matanggaran' => '2.2.17',
                'kode_aas' => '5010002517',
                'saldo' => 0,
            ],
            [
                'id' => 14,
                'kode_matanggaran' => '2.2.18',
                'kode_aas' => '5010002513',
                'saldo' => 3000000,
            ],
            [
                'id' => 15,
                'kode_matanggaran' => '2.2.19',
                'kode_aas' => '5010002514',
                'saldo' => 2000000,
            ],
            [
                'id' => 16,
                'kode_matanggaran' => '2.1.51',
                'kode_aas' => '5010005501',
                'saldo' => 500000000,
            ],
            [
                'id' => 17,
                'kode_matanggaran' => '2.1.52',
                'kode_aas' => '5010005502',
                'saldo' => 1079166540,
            ],
            [
                'id' => 18,
                'kode_matanggaran' => '1.1.1',
                'kode_aas' => '1111111111',
                'saldo' => 25000000,
            ],
            [
                'id' => 19,
                'kode_matanggaran' => '1.1.2',
                'kode_aas' => '1111111112',
                'saldo' => 25000000,
            ],
            [
                'id' => 31,
                'kode_matanggaran' => '2.1.11',
                'kode_aas' => '5010001501',
                'saldo' => 7000000,
            ],
            [
                'id' => 32,
                'kode_matanggaran' => '2.1.12',
                'kode_aas' => '5010001502',
                'saldo' => 5000000,
            ],
            [
                'id' => 33,
                'kode_matanggaran' => '2.1.13',
                'kode_aas' => '5010001503',
                'saldo' => 6000000,
            ],
            [
                'id' => 34,
                'kode_matanggaran' => '2.1.15',
                'kode_aas' => '5010001505',
                'saldo' => 5000000,
            ],
            [
                'id' => 35,
                'kode_matanggaran' => '2.1.23',
                'kode_aas' => '5010002503',
                'saldo' => 1000000,
            ],
            [
                'id' => 36,
                'kode_matanggaran' => '2.1.29',
                'kode_aas' => '5010002509',
                'saldo' => 1000000,
            ],
            [
                'id' => 38,
                'kode_matanggaran' => '2.1.53',
                'kode_aas' => '5010005503',
                'saldo' => 84539500,
            ],
            [
                'id' => 39,
                'kode_matanggaran' => '2.1.54',
                'kode_aas' => '5010006504',
                'saldo' => 70407590,
            ],
            [
                'id' => 40,
                'kode_matanggaran' => '2.1.55',
                'kode_aas' => '5010006505',
                'saldo' => 500000,
            ],
            [
                'id' => 42,
                'kode_matanggaran' => '2.1.71',
                'kode_aas' => '5020406501',
                'saldo' => 20500000,
            ],
            [
                'id' => 43,
                'kode_matanggaran' => '2.1.72',
                'kode_aas' => '5020406502',
                'saldo' => 3500000,
            ],
            [
                'id' => 44,
                'kode_matanggaran' => '2.3.7',
                'kode_aas' => '2070010523',
                'saldo' => 1500000,
            ],
            [
                'id' => 45,
                'kode_matanggaran' => '2.3.6',
                'kode_aas' => '2070010508',
                'saldo' => 27000000,
            ],
            [
                'id' => 47,
                'kode_matanggaran' => '2.1.91',
                'kode_aas' => '5060001501',
                'saldo' => 0,
            ],
        ];

        // Memasukkan data ke tabel 'akun_matanggaran'
        DB::table('akun_matanggaran')->insert($data);
    }
}
