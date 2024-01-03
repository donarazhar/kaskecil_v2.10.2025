<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function index()
    {

        $matanggaran = DB::table('akun_matanggaran')
            ->select('akun_matanggaran.*', 'akun_aas.*')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->orderBy('kode_matanggaran', 'ASC')
            ->get();

        $totalSaldo = DB::table('akun_matanggaran')->sum('saldo');


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

        return view('welcome', compact('transaksi', 'total_pembentukan', 'total_pengisian', 'total_pengeluaran', 'total_pengeluaran', 'total_result', 'matanggaran', 'totalSaldo'));
    }
}
