<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class TransaksiController extends Controller
{
    public function index()
    {
        $items = DB::table('transaksi')
            ->select('transaksi.*', 'saldo.total as saldo')
            ->leftJoin('saldo', 'transaksi.saldo_id', '=', 'saldo.id')
            ->orderByRaw("YEAR(transaksi.created_at) DESC, MONTH(transaksi.created_at) DESC")
            ->orderBy('transaksi.created_at', 'asc')
            ->get();


        return view('pages.transaksi.index', compact('items'));
    }

    public function indexPemasukan()
    {
        $items = DB::table('transaksi')
            ->where('kategori', 'pemasukan')
            ->orderBy('transaksi.created_at', 'asc')
            ->get();

        session()->forget('info');
        return view('pages.transaksi.pemasukan.index', compact('items'));
    }

    public function createPemasukan()
    {

        return view('pages.transaksi.pemasukan.create');
    }

    public function indexPengeluaran()
    {
        $items = DB::table('transaksi')
            ->where('kategori', 'pengeluaran')
            ->orderBy('transaksi.created_at', 'asc')
            ->get();

        session()->forget('info');
        return view('pages.transaksi.pengeluaran.index', compact('items'));
    }

    public function createPengeluaran()
    {

        return view('pages.transaksi.pengeluaran.create');
    }

    public function store(Request $request)
    {
        try {
            $saldo_sekarang = DB::table('saldo')
                ->latest('created_at')
                ->first();

            if ($saldo_sekarang === null) {
                $saldo_sekarang = 0;
            } else {
                $saldo_sekarang = $saldo_sekarang->total;
            }

            // Membersihkan tanda koma dari $request->jumlah
            $jumlah_cleaned = str_replace(['.', ','], '', $request->jumlah);
            // Konversi ke integer
            $jumlah_numeric = intval($jumlah_cleaned);

            // Validasi nilai numerik sebelum operasi matematika
            if (!is_numeric($saldo_sekarang) || !is_numeric($jumlah_numeric)) {
                // Tangani jika salah satu atau keduanya bukan numerik
                return redirect()->back()->with('pesan', "Salah input");
            }

            // Lakukan operasi matematika hanya jika keduanya numerik
            $total = ($request->kategori == 'pemasukan') ? $saldo_sekarang + $jumlah_numeric : $saldo_sekarang - $jumlah_numeric;

            // Insert data saldo
            $saldo_id = DB::table('saldo')->insertGetId([
                'total' => $total,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert data transaksi dengan ID saldo yang baru saja dibuat
            DB::table('transaksi')->insert([
                'saldo_id' => $saldo_id,
                'jumlah' => $jumlah_numeric, // Menggunakan nilai numerik
                'perincian' => $request->perincian,
                'kategori' => $request->kategori,
                'tanggal' => $request->tanggal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', "Input data {$request->kategori} sukses");
        } catch (\Exception $e) {
            // Tangani exception dan tampilkan pesan error jika terjadi kesalahan
            return redirect()->back()->with('pesan', "Terjadi kesalahan: " . $e->getMessage());
        }
    }

    public function cari(Request $request)
    {
        $saldo = DB::table('saldo')
            ->latest('created_at')
            ->first();

        $tanggal_awal = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('d-m-Y', strtotime($request->tanggal_akhir));

        if ($request->kategori == 'transaksi') {
            $items = DB::table('transaksi_requests')
                ->select('transaksi_requests.*')
                ->join('saldo', 'transaksi_requests.saldo_id', '=', 'saldo.id')
                ->whereBetween('transaksi_requests.tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();
        } else {
            $items = DB::table('transaksi_requests')
                ->select('transaksi_requests.*')
                ->join('saldo', 'transaksi_requests.saldo_id', '=', 'saldo.id')
                ->where('transaksi_requests.kategori', $request->kategori)
                ->whereBetween('transaksi_requests.tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();
        }

        session()->flash('info', "Hasil {$request->kategori} tanggal {$tanggal_awal} sampai {$tanggal_akhir}");

        if ($request->kategori == 'transaksi') {
            return view('pages.transaksi.index', ['items' => $items, 'saldo' => $saldo]);
        } elseif ($request->kategori == 'pemasukan') {
            return view('pages.transaksi.pemasukan.index', ['items' => $items]);
        } elseif ($request->kategori == 'pengeluaran') {
            return view('pages.transaksi.pengeluaran.index', ['items' => $items]);
        }
    }

    public function edit($id)
    {

        $item = DB::table('transaksi')->where('id', $id)->first();

        if (!$item) {
            abort(404); // Atau tindakan lain sesuai kebutuhan aplikasi Anda
        }

        return view('pages.transaksi.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {

        $transaksi = DB::table('transaksi')->where('id', $id)->first();

        if (!$transaksi) {
            abort(404); // Atau tindakan lain sesuai kebutuhan aplikasi Anda
        }

        $saldo = DB::table('saldo')->where('id', $transaksi->saldo_id)->first();

        if (!$saldo) {
            abort(404); // Atau tindakan lain sesuai kebutuhan aplikasi Anda
        }


        if ($request->kategori == 'pemasukan') {
            if ($request->jumlah == $transaksi->jumlah) {
                $transaksi->update($request->all());
            } elseif ($request->jumlah > $transaksi->jumlah) {
                $selisih = $request->jumlah - $transaksi->jumlah;
                $saldo_total = $saldo->total + $selisih;

                $saldo_terdampak = DB::table('saldo')->where('id', '>', $saldo->id)->get();
                foreach ($saldo_terdampak as $item) {
                    $item->update([
                        'total' => $item->total + $selisih
                    ]);
                }
                $saldo->update(['total' => $saldo_total]);
                $saldo->transaksi()->update([
                    'jumlah' => $request->jumlah,
                    'kategori' => $request->kategori,
                    'tanggal' => $request->tanggal,
                    'perincian' => $request->perincian,
                ]);
            } elseif ($request->jumlah < $transaksi->jumlah) {
                $selisih = $transaksi->jumlah - $request->jumlah;
                $saldo_total = $saldo->total - $selisih;

                $saldo_terdampak = DB::table('saldo')->where('id', '>', $saldo->id)->get();

                foreach ($saldo_terdampak as $item) {
                    $item->update([
                        'total' => $item->total - $selisih
                    ]);
                }
                $saldo->update(['total' => $saldo_total]);
                $saldo->transaksi()->update([
                    'jumlah' => $request->jumlah,
                    'kategori' => $request->kategori,
                    'tanggal' => $request->tanggal,
                    'perincian' => $request->perincian,
                ]);
            }
            Alert::success('Sukses', 'Update transaksi berhasil');
            return redirect()->back()->with('pesan', 'Update transaksi berhasil');
        }

        if ($request->kategori == 'pengeluaran') {
            if ($request->jumlah == $transaksi->jumlah) {
                $transaksi->update($request->all());
            } elseif ($request->jumlah > $transaksi->jumlah) {
                $selisih = $request->jumlah - $transaksi->jumlah;
                $saldo_total = $saldo->total - $selisih;

                $saldo_terdampak = DB::table('saldo')->where('id', '>', $saldo->id)->get();

                foreach ($saldo_terdampak as $item) {
                    $item->update([
                        'total' => $item->total - $selisih
                    ]);
                }
                $saldo->update(['total' => $saldo_total]);
                $saldo->transaksi()->update([
                    'jumlah' => $request->jumlah,
                    'kategori' => $request->kategori,
                    'tanggal' => $request->tanggal,
                    'perincian' => $request->perincian,
                ]);
            } elseif ($request->jumlah < $transaksi->jumlah) {
                $selisih = $transaksi->jumlah - $request->jumlah;
                $saldo_total = $saldo->total + $selisih;

                $saldo_terdampak = DB::table('saldo')->where('id', '>', $saldo->id)->get();

                foreach ($saldo_terdampak as $item) {
                    $item->update([
                        'total' => $item->total + $selisih
                    ]);
                }
                $saldo->update(['total' => $saldo_total]);
                $saldo->transaksi()->update([
                    'jumlah' => $request->jumlah,
                    'kategori' => $request->kategori,
                    'tanggal' => $request->tanggal,
                    'perincian' => $request->perincian,
                ]);
            }
            Alert::success('Sukses', 'Update transaksi berhasil');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $transaksi = DB::table('transaksi')
            ->select('transaksi.*', 'saldo.*') // Include columns from both tables
            ->join('saldo', 'transaksi.saldo_id', '=', 'saldo.id')
            ->where('transaksi.id', $id)
            ->first();

        if (!$transaksi) {
            abort(404); // Or handle not found case as needed for your application
        }

        $saldo = DB::table('saldo')
            ->where('id', $transaksi->saldo_id)
            ->first();

        if (!$saldo) {
            abort(404); // Or handle not found case as needed for your application
        }


        if ($transaksi->kategori == 'pemasukan') {
            $saldo_terdampak = DB::table('saldo')->where('id', '>', $saldo->id)->get();

            foreach ($saldo_terdampak as $item) {
                $item->update([
                    'total' => $item->total - $transaksi->jumlah,
                ]);
            }
        }

        if ($transaksi->kategori == 'pengeluaran') {
            $saldo_terdampak = DB::table('saldo')->where('id', '>', $saldo->id)->get();

            foreach ($saldo_terdampak as $item) {
                $item->update([
                    'total' => $item->total + $transaksi->jumlah,
                ]);
            }
        }


        $saldo->transaksi->delete();
        $saldo->delete();

        Alert::success('Sukses', 'Hapus transaksi berhasil');
        return redirect()->back();
    }

    public function laporan()
    {

        return view('pages.transaksi.laporan');
    }

    public function laporanPDF(Request $request)
    {

        $kategori = $request->kategori;
        $tanggal_awal = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('d-m-Y', strtotime($request->tanggal_akhir));
        $periode = $tanggal_awal . " sampai " . $tanggal_akhir;
        $transaksi_terakhir = DB::table('transaksi')
            ->whereDate('tanggal', '<', $request->tanggal_awal)
            ->latest('tanggal')
            ->first();

        if ($transaksi_terakhir == null) {
            $saldo_terakhir = 0;
        } else {
            $saldo_terakhir = DB::table('saldo')
                ->where('id', $transaksi_terakhir->saldo_id)
                ->first();
        }

        if ($kategori == 'semua') {
            $items = DB::table('transaksi')
                ->select('transaksi.*', 'saldo.*') // Include columns from both tables
                ->join('saldo', 'transaksi.saldo_id', '=', 'saldo.id')
                ->whereBetween('transaksi.tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();

            $pdf = FacadePdf::loadView('pages.transaksi.laporan_pdf', [
                'items' => $items,
                'periode' => $periode,
                'saldo_terakhir' => $saldo_terakhir
            ]);
            return $pdf->stream("Laporan Transaksi {$periode}");
        } elseif ($kategori == 'pemasukan') {
            $items = DB::table('transaksi')
                ->select('transaksi.*', 'saldo.*') // Include columns from both tables
                ->join('saldo', 'transaksi.saldo_id', '=', 'saldo.id')
                ->where('transaksi.kategori', 'pemasukan')
                ->whereBetween('transaksi.tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();

            $pdf = FacadePdf::loadView('pages.transaksi.pemasukan.laporan_pdf', [
                'items' => $items,
                'periode' => $periode
            ]);
            return $pdf->stream("Laporan Pemasukan {$periode}");
        } elseif ($kategori == 'pengeluaran') {
            $items = DB::table('transaksi')
                ->select('transaksi.*', 'saldo.*') // Include columns from both tables
                ->join('saldo', 'transaksi.saldo_id', '=', 'saldo.id')
                ->where('transaksi.kategori', 'pengeluaran')
                ->whereBetween('transaksi.tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();

            $pdf = FacadePdf::loadView('pages.transaksi.pengeluaran.laporan_pdf', [
                'items' => $items,
                'periode' => $periode
            ]);
            return $pdf->stream("Laporan Pengeluaran {$periode}");
        }
    }
}
