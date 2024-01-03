<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function beranda()
    {

        $matanggaran = DB::table('akun_matanggaran')
            ->select('akun_matanggaran.*', 'akun_aas.*')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->orderBy('kode_matanggaran', 'ASC')
            ->get();

        $totalSaldo = DB::table('akun_matanggaran')->sum('saldo');
        $pengeluaran = DB::table('transaksi')
            ->select(
                'transaksi.kode_matanggaran',
                'akun_aas.nama_aas',
                DB::raw('EXTRACT(MONTH FROM transaksi.tanggal) AS bulan'),
                DB::raw('EXTRACT(YEAR FROM transaksi.tanggal) AS tahun'),
                DB::raw('SUM(transaksi.jumlah) AS total_pengeluaran')
            )
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', 'pengeluaran')
            ->groupBy('transaksi.kode_matanggaran', 'bulan', 'tahun', 'akun_aas.nama_aas')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->orderBy('transaksi.kode_matanggaran')
            ->get();


        $transaksi = DB::table('transaksi')
            ->select('transaksi.*', 'saldo.total as saldo', 'akun_aas.*', 'akun_matanggaran.*')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->leftJoin('saldo', 'transaksi.saldo_id', '=', 'saldo.id')
            ->orderByRaw("YEAR(transaksi.created_at) ASC, MONTH(transaksi.created_at) ASC")
            ->orderBy('transaksi.created_at', 'asc')
            ->get();

        $result = DB::table('transaksi')
            ->select(
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pembentukan" THEN jumlah ELSE 0 END), 0) AS total_pembentukan'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pengisian" THEN jumlah ELSE 0 END), 0) AS total_pengisian'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pengeluaran" THEN jumlah ELSE 0 END), 0) AS total_pengeluaran'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori IN ("pembentukan", "pengisian") THEN jumlah ELSE 0 END), 0) - 
                COALESCE(SUM(CASE WHEN kategori = "pengeluaran" THEN jumlah ELSE 0 END), 0) AS total_result')
            )
            ->first();

        // Access the results
        $total_pembentukan = $result->total_pembentukan;
        $total_pengisian = $result->total_pengisian;
        $total_pengeluaran = $result->total_pengeluaran;
        $total_result = $result->total_result;

        return view('pages.beranda', compact('transaksi', 'total_pembentukan', 'total_pengisian', 'total_pengeluaran', 'total_pengeluaran', 'total_result', 'matanggaran', 'totalSaldo', 'pengeluaran'));
    }
}
