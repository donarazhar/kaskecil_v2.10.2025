<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransaksiRequest;
use App\Http\Requests\CariTransaksiRequest;
use App\Http\Requests\LaporanTransaksiRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Saldo;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class TransaksiController extends Controller
{
    public function index()
    {
        $items = Transaksi::with('saldo')->latest()->get();
        $saldo = Saldo::latest()->first();

        session()->forget('info');
        return view('pages.transaksi.index', ['items' => $items, 'saldo' => $saldo]);
    }

    public function indexPemasukan()
    {
        $items = Transaksi::where('kategori', 'pemasukan')->latest()->get();

        session()->forget('info');
        return view('pages.transaksi.pemasukan.index', ['items' => $items]);
    }

    public function createPemasukan()
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        return view('pages.transaksi.pemasukan.create');
    }

    public function indexPengeluaran()
    {
        $items = Transaksi::where('kategori', 'pengeluaran')->latest()->get();

        session()->forget('info');
        return view('pages.transaksi.pengeluaran.index', ['items' => $items]);
    }

    public function createPengeluaran()
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        return view('pages.transaksi.pengeluaran.create');
    }

    public function store(TransaksiRequest $request)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $saldo_sekarang = Saldo::latest()->first();
        if ($saldo_sekarang === null) {
            $saldo_sekarang = 0;
        } else {
            $saldo_sekarang = $saldo_sekarang->total;
        }

        if ($request->kategori == 'pemasukan') {
            $total = $saldo_sekarang + $request->jumlah;
        } else {
            $total = $saldo_sekarang - $request->jumlah;
        }

        $saldo = Saldo::create([
            'total' => $total,
        ]);

        $saldo->transaksi()->create($request->all());

        return redirect()->back()->with('pesan', "Input data {$request->kategori} sukses");
    }

    public function cari(CariTransaksiRequest $request)
    {
        $saldo = Saldo::latest()->first();
        $tanggal_awal = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('d-m-Y', strtotime($request->tanggal_akhir));

        if ($request->kategori == 'transaksi') {
            $items = TransaksiRequest::with('saldo')->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
        } else {
            $items = TransaksiRequest::with('saldo')->where('kategori', $request->kategori)->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
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
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $item = Transaksi::findOrfail($id);
        return view('pages.transaksi.edit', ['item' => $item]);
    }

    public function update(TransaksiRequest $request, $id)
    {
        // $this->authorize('isAdminO                      rBendahara', Transaksi::class);
        $transaksi = Transaksi::findOrfail($id);
        $saldo = Saldo::where('id', $transaksi->saldo_id)->first();

        if ($request->kategori == 'pemasukan') {
            if ($request->jumlah == $transaksi->jumlah) {
                $transaksi->update($request->all());
            } elseif ($request->jumlah > $transaksi->jumlah) {
                $selisih = $request->jumlah - $transaksi->jumlah;
                $saldo_total = $saldo->total + $selisih;

                $saldo_terdampak = Saldo::where('id', '>', $saldo->id)->get();
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

                $saldo_terdampak = Saldo::where('id', '>', $saldo->id)->get();
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

                $saldo_terdampak = Saldo::where('id', '>', $saldo->id)->get();
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

                $saldo_terdampak = Saldo::where('id', '>', $saldo->id)->get();
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
        // $this->authorize('isAdmin', Transaksi::class);
        $transaksi = Transaksi::with('saldo')->findOrFail($id);
        $saldo = Saldo::findOrFail($transaksi->saldo_id);

        if ($transaksi->kategori == 'pemasukan') {
            $saldo_terdampak = Saldo::where('id', '>', $saldo->id)->get();
            foreach ($saldo_terdampak as $item) {
                $item->update([
                    'total' => $item->total - $transaksi->jumlah,
                ]);
            }
        }

        if ($transaksi->kategori == 'pengeluaran') {
            $saldo_terdampak = Saldo::where('id', '>', $saldo->id)->get();
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
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        return view('pages.transaksi.laporan');
    }

    public function laporanPDF(LaporanTransaksiRequest $request)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $kategori = $request->kategori;
        $tanggal_awal = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('d-m-Y', strtotime($request->tanggal_akhir));
        $periode = $tanggal_awal . " sampai " . $tanggal_akhir;
        $transaksi_terakhir = Transaksi::whereDate('tanggal', '<', $request->tanggal_awal)->latest()->first();
        if ($transaksi_terakhir == null) {
            $saldo_terakhir = 0;
        } else {
            $saldo_terakhir = Saldo::where('id', $transaksi_terakhir->saldo_id)->first();
        }

        if ($kategori == 'semua') {
            $items = Transaksi::with('saldo')->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
            $pdf = FacadePdf::loadView('pages.transaksi.laporan_pdf', [
                'items' => $items,
                'periode' => $periode,
                'saldo_terakhir' => $saldo_terakhir
            ]);
            return $pdf->stream("Laporan Transaksi {$periode}");
        } elseif ($kategori == 'pemasukan') {
            $items = Transaksi::with('saldo')->where('kategori', 'pemasukan')->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
            $pdf = FacadePdf::loadView('pages.transaksi.pemasukan.laporan_pdf', [
                'items' => $items,
                'periode' => $periode
            ]);
            return $pdf->stream("Laporan Pemasukan {$periode}");
        } elseif ($kategori == 'pengeluaran') {
            $items = Transaksi::with('saldo')->where('kategori', 'pengeluaran')->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
            $pdf = FacadePdf::loadView('pages.transaksi.pengeluaran.laporan_pdf', [
                'items' => $items,
                'periode' => $periode
            ]);
            return $pdf->stream("Laporan Pengeluaran {$periode}");
        }
    }
}
