<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    // Fungsi ini menangani logika untuk halaman utama aplikasi.
    public function index()
    {
        // Mendapatkan bulan dan tahun saat ini.
        $bulanini = date("m");
        $tahunini = date("Y");
        // Array untuk mengubah angka bulan menjadi nama bulan dalam Bahasa Indonesia.
        $namaIndonesia = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        $namaBulan = $namaIndonesia[$bulanini - 1];

        // Mengambil data mata anggaran beserta data akun AAS yang berelasi.
        $matanggaran = DB::table('akun_matanggaran')
            ->select('akun_matanggaran.*', 'akun_aas.*')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->orderBy('kode_matanggaran', 'ASC')
            ->get();

        // Mengambil data transaksi dengan kategori 'pembentukan'.
        $pembentukan = DB::table('transaksi')->where('kategori', 'pembentukan')
            ->get();

        // Mengambil rekapitulasi transaksi per bulan pada tahun ini.
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

        // Mengambil data pengeluaran pada bulan dan tahun ini.
        $pengeluaranbulanini = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', 'pengeluaran')
            ->whereRaw('MONTH(tanggal)="' . $bulanini . '"')
            ->whereRaw('YEAR(tanggal)="' . $tahunini . '"')
            ->get();

        // Mengambil data pengisian pada bulan dan tahun ini.
        $pengisianbulanini = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', 'pengisian')
            ->whereRaw('MONTH(tanggal)="' . $bulanini . '"')
            ->whereRaw('YEAR(tanggal)="' . $tahunini . '"')
            ->get();

        // Menghitung saldo berjalan dari semua transaksi.
        $saldoberjalan = DB::table('transaksi')
            ->select(
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pembentukan" THEN jumlah ELSE 0 END), 0) AS total_pembentukan'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pengisian" THEN jumlah ELSE 0 END), 0) AS total_pengisian'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pengeluaran" THEN jumlah ELSE 0 END), 0) AS total_pengeluaran'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori IN ("pembentukan", "pengisian") THEN jumlah ELSE 0 END), 0) - 
                COALESCE(SUM(CASE WHEN kategori = "pengeluaran" THEN jumlah ELSE 0 END), 0) AS total_result')
            )
            ->first();

        // Mengambil histori transaksi pengisian.
        $pengisian = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', '=', 'pengisian')
            ->orderBy('transaksi.created_at', 'ASC')
            ->get();

        // Mengambil histori transaksi pengisian dari tabel shadow.
        $pengisianShadow = DB::table('transaksi_shadow')
            ->select('transaksi_shadow.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi_shadow.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi_shadow.kategori', '=', 'pengisian')
            ->orderBy('transaksi_shadow.created_at', 'ASC')
            ->get();

        // Menggabungkan data pengisian dari tabel utama dan shadow, lalu diurutkan berdasarkan tanggal pembuatan.
        $combinedData = $pengisian->merge($pengisianShadow)->sortByDesc('created_at');
        // Membuat paginasi untuk data gabungan.
        $combinedData = new \Illuminate\Pagination\LengthAwarePaginator(
            $combinedData->forPage(\Illuminate\Pagination\Paginator::resolveCurrentPage(), 4),
            $combinedData->count(),
            4,
            \Illuminate\Pagination\Paginator::resolveCurrentPage()
        );

        // Mengirimkan semua data yang telah diolah ke view 'k_home'.
        return view('k_home', compact('matanggaran', 'pembentukan', 'rekapperbulan', 'pengeluaranbulanini', 'pengisianbulanini', 'tahunini', 'namaBulan', 'saldoberjalan', 'combinedData'));
    }
}
