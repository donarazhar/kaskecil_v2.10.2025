<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages.laporan.index');
    }

    public function cetaklaporan(Request $request)
    {

        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas', 'akun_aas.status', 'akun_aas.kategori')
            ->orderBy('kode_aas', 'ASC')
            ->get();


        $periodeawal = $request->input('tanggalawal', '');
        $periodeakhir = $request->input('tanggalakhir', '');

        $pengeluaranbulanini = DB::table('transaksi')
            ->select('akun_matanggaran.kode_matanggaran', 'akun_aas.kode_aas', 'akun_aas.nama_aas', 'transaksi.jumlah', 'transaksi.perincian', 'transaksi.jumlah')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', '=', 'pengeluaran')
            ->whereBetween('transaksi.tanggal', [$periodeawal, $periodeakhir])
            ->orderBy('akun_matanggaran.kode_matanggaran', 'ASC')
            ->get();

        $totalpengeluaran = DB::table('transaksi')
            ->select(DB::raw('SUM(jumlah) AS total_pengeluaran'))
            ->where('transaksi.kategori', '=', 'pengeluaran')
            ->whereBetween('tanggal', [$periodeawal, $periodeakhir])
            ->first();

        return view('pages.laporan.cetaklaporan', compact('request', 'matanggaran', 'totalpengeluaran', 'pengeluaranbulanini',  'periodeawal', 'periodeakhir'));
    }
}
