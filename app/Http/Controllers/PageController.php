<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function beranda()
    {

        $bulanini = date("m");
        $tahunini = date("Y");
        $namaIndonesia = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        $namaBulan = $namaIndonesia[$bulanini - 1];

        // Menampilkan semua tabel akun AAS dan akun Mat Anggaran
        $matanggaran = DB::table('akun_matanggaran')
            ->select('akun_matanggaran.*', 'akun_aas.*')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->orderBy('kode_matanggaran', 'ASC')
            ->get();

        // Untuk data awal pembentukan
        $pembentukan = DB::table('transaksi')->where('kategori', 'pembentukan')
            ->get();

        // Untuk Data Rekap histori
        $rekapperbulan = DB::table('transaksi')
            ->select(
                'transaksi.kode_matanggaran',
                DB::raw('SUM(transaksi.jumlah) as total_perbulan'),
                DB::raw('MONTH(transaksi.tanggal) as bulan'),
                'akun_aas.nama_aas'
            )
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->whereIn('transaksi.kategori', ['pengisian', 'pengeluaran', 'pembentukan'])
            ->whereMonth('transaksi.tanggal', '=', $bulanini)
            ->whereYear('transaksi.tanggal', '=', $tahunini)
            ->groupBy('transaksi.kode_matanggaran', 'bulan', 'akun_aas.nama_aas')
            ->get();

        // Untuk Datatables khusus pengeluaran
        $pengeluaranbulanini = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', 'pengeluaran')
            ->whereRaw('MONTH(tanggal)="' . $bulanini . '"')
            ->whereRaw('YEAR(tanggal)="' . $tahunini . '"')
            ->get();

        // Untuk Datatables khusus pengeluaran
        $pengisianbulanini = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', 'pengisian')
            ->whereRaw('MONTH(tanggal)="' . $bulanini . '"')
            ->whereRaw('YEAR(tanggal)="' . $tahunini . '"')
            ->get();

        // MEndapatkan Saldo Berjalan
        $saldoberjalan = DB::table('transaksi')
            ->select(
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pembentukan" THEN jumlah ELSE 0 END), 0) AS total_pembentukan'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pengisian" THEN jumlah ELSE 0 END), 0) AS total_pengisian'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pengeluaran" THEN jumlah ELSE 0 END), 0) AS total_pengeluaran'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori IN ("pembentukan", "pengisian") THEN jumlah ELSE 0 END), 0) - 
                COALESCE(SUM(CASE WHEN kategori = "pengeluaran" THEN jumlah ELSE 0 END), 0) AS total_result')
            )
            ->first();

        // Mendapatkan History pengisian
        $pengisian = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', '=', 'pengisian')
            ->orderBy('transaksi.created_at', 'ASC')
            ->get(); // Menambahkan paginate dengan jumlah perpage 4

        $pengisianShadow = DB::table('transaksi_shadow')
            ->select('transaksi_shadow.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi_shadow.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi_shadow.kategori', '=', 'pengisian')
            ->orderBy('transaksi_shadow.created_at', 'ASC')
            ->get(); // Menambahkan paginate dengan jumlah perpage 4

        $combinedData = $pengisian->merge($pengisianShadow)->sortByDesc('created_at');
        $combinedData = new \Illuminate\Pagination\LengthAwarePaginator(
            $combinedData->forPage(\Illuminate\Pagination\Paginator::resolveCurrentPage(), 4),
            $combinedData->count(),
            4,
            \Illuminate\Pagination\Paginator::resolveCurrentPage()
        );


        return view('pages.beranda', compact('matanggaran', 'pembentukan', 'rekapperbulan', 'pengeluaranbulanini', 'pengisianbulanini', 'tahunini', 'namaBulan', 'saldoberjalan', 'combinedData'));
    }
}
