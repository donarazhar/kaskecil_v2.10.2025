<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Saldo;
use App\Models\Transaksi;
use Carbon\Carbon;


class PageController extends Controller
{

    public function beranda()
    {
        $items = Transaksi::with('saldo')->latest()->limit(10)->get();
        $saldo = Saldo::latest()->first();
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM YYYY');
        $pemasukan = Transaksi::where('kategori', 'pemasukan')->whereBetween('tanggal', [date('Y-m-01'), date('Y-m-31')])->get();
        $jumlah_pemasukan = 0;
        foreach ($pemasukan as $item) {
            $jumlah_pemasukan += $item->jumlah;
        }

        $pengeluaran = Transaksi::where('kategori', 'pengeluaran')->whereBetween('tanggal', [date('Y-m-01'), date('Y-m-31')])->get();
        $jumlah_pengeluaran = 0;
        foreach ($pengeluaran as $item) {
            $jumlah_pengeluaran += $item->jumlah;
        }

        return view(
            'pages.beranda',
            [
                'items' => $items,
                'saldo' => $saldo,
                'tanggal' => $tanggal,
                'jumlah_pemasukan' => $jumlah_pemasukan,
                'jumlah_pengeluaran' => $jumlah_pengeluaran
            ]
        );
    }
}
