<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class TransaksiController extends Controller
{
    // Index Menu Home Transaksi
    public function index()
    {
        $items = DB::table('transaksi')
            ->select('transaksi.*', 'saldo.total as saldo', 'akun_aas.*', 'akun_matanggaran.*')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->leftJoin('saldo', 'transaksi.saldo_id', '=', 'saldo.id')
            ->orderByRaw("YEAR(transaksi.created_at) DESC, MONTH(transaksi.created_at) DESC")
            ->orderBy('transaksi.created_at', 'asc')
            ->get();


        return view('pages.transaksi.index', compact('items'));
    }

    // Menu GLOBAL store semua transaksi
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
            $total = ($request->kategori == 'pembentukan') ? $saldo_sekarang + $jumlah_numeric : $saldo_sekarang - $jumlah_numeric;


            // Insert data saldo
            $saldo_id = DB::table('saldo')->insertGetId([
                'total' => $total,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert data transaksi dengan ID saldo yang baru saja dibuat
            DB::table('transaksi')->insert([
                'saldo_id' => $saldo_id,
                'jumlah' => $jumlah_numeric,
                'perincian' => $request->perincian,
                'kategori' => $request->kategori,
                'tanggal' => $request->tanggal,
                'kode_matanggaran' => $request->kode_matanggaran,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', "Input data {$request->kategori} sukses");
        } catch (\Exception $e) {
            // Tangani exception dan tampilkan pesan error jika terjadi kesalahan
            return redirect()->back()->with('warning', "Terjadi kesalahan: " . $e->getMessage());
        }
    }

    // Index Menu Pembentukan Kas Kecil
    public function indexPembentukan()
    {
        $pembentukan = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', '=', 'pembentukan')
            ->orderBy('transaksi.created_at', 'ASC')
            ->get();

        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas', 'akun_aas.status', 'akun_aas.kategori')
            ->orderBy('kode_aas', 'ASC')
            ->get();


        return view('pages.transaksi.pembentukan.index', compact('pembentukan', 'matanggaran'));
    }

    // Edit Menu Pembentukan Kas Kecil
    public function editPembentukan(Request $request)
    {
        $id = $request->id;
        $transaksi = DB::table('transaksi')->where('id', $id)->first();
        $pembentukan = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_matanggaran', 'akun_aas.nama_aas')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.id', $id)
            ->first();

        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas', 'akun_aas.status', 'akun_aas.kategori')
            ->orderBy('kode_aas', 'ASC')
            ->get();

        return view('pages.transaksi.pembentukan.edit', compact('transaksi', 'pembentukan', 'matanggaran'));
    }

    // Update Menu Pembentukan Kas Kecil
    public function updatePembentukan(Request $request, $id)
    {
        $transaksi = DB::table('transaksi')->where('id', $id)->first();

        if (!$transaksi) {
            // Handle kesalahan, misalnya lempar exception atau tampilkan pesan
            abort(404, 'Transaksi tidak ditemukan');
        }

        // Lanjutkan dengan pengolahan data $transaksi
        $saldo = DB::table('saldo')->where('id', $transaksi->saldo_id)->first();

        if ($request->kategori == 'pembentukan') {
            if ($request->jumlah == $transaksi->jumlah) {
                DB::table('transaksi')
                    ->where('id', $transaksi->id)
                    ->update($request->only(['jumlah', 'kategori', 'tanggal', 'perincian']));
            } elseif ($request->jumlah > $transaksi->jumlah) {
                $selisih = $request->jumlah - $transaksi->jumlah;
                $saldo_total = $saldo->total + $selisih;

                $saldo_terdampak = DB::table('saldo')
                    ->where('id', '>', $saldo->id)
                    ->get();

                foreach ($saldo_terdampak as $item) {
                    DB::table('saldo')
                        ->where(
                            'id',
                            $item->id
                        )
                        ->update(['total' => $item->total + $selisih]);
                }

                DB::table('saldo')
                    ->where('id', $saldo->id)
                    ->update(['total' => $saldo_total]);

                DB::table('transaksi')
                    ->where('id', $transaksi->id)
                    ->update([
                        'jumlah' => $request->jumlah,
                        'kategori' => "'" . $request->kategori . "'", // Tambahkan tanda kutip untuk nilai string
                        'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
                        'perincian' => "'" . $request->perincian . "'", // Tambahkan tanda kutip untuk nilai string
                    ]);
            } elseif ($request->jumlah < $transaksi->jumlah) {
                // Membersihkan tanda koma dari $request->jumlah
                $jumlah_cleaned_request = str_replace(['.', ','], '', $request->jumlah);
                // Konversi ke tipe data numerik
                $jumlah_numeric_request = is_numeric($jumlah_cleaned_request) ? floatval($jumlah_cleaned_request) : null;
                // Membersihkan tanda koma dari $transaksi->jumlah
                $jumlah_cleaned_transaksi = str_replace(['.', ','], '', $transaksi->jumlah);
                // Konversi ke tipe data numerik
                $jumlah_numeric_transaksi = is_numeric($jumlah_cleaned_transaksi) ? floatval($jumlah_cleaned_transaksi) : null;
                // Sekarang, Anda dapat menggunakan $jumlah_numeric_transaksi dan $jumlah_numeric_request untuk operasi matematika
                $selisih = $jumlah_numeric_transaksi - $jumlah_numeric_request;

                $saldo_total = $saldo->total - $selisih;

                $saldo_terdampak = DB::table('saldo')
                    ->where('id', '>', $saldo->id)
                    ->get();

                foreach ($saldo_terdampak as $item) {
                    DB::table('saldo')
                        ->where(
                            'id',
                            $item->id
                        )
                        ->update(['total' => $item->total - $selisih]);
                }

                DB::table('saldo')
                    ->where('id', $saldo->id)
                    ->update(['total' => $saldo_total]);

                DB::table('transaksi')
                    ->where('id', $transaksi->id)
                    ->update([
                        'jumlah' => $jumlah_cleaned_request,
                        'kategori' => 'pembentukan',
                        'tanggal' => $request->tanggal,
                        'perincian' => $request->perincian,
                    ]);
            }

            return redirect()->back()->with('pesan', 'Update transaksi berhasil');
        }
    }

    // Index Menu Pengeluaran Kas Kecil
    public function indexPengeluaran()
    {
        $items = DB::table('transaksi')
            ->where('kategori', 'pengeluaran')
            ->orderBy('transaksi.created_at', 'asc')
            ->get();

        session()->forget('info');
        return view('pages.transaksi.pengeluaran.index', compact('items'));
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

    public function destroy($id)
    {
        $transaksi = DB::table('transaksi')
            ->join('saldo', 'transaksi.saldo_id', '=', 'saldo.id')
            ->select('transaksi.*', 'saldo.*')
            ->where('transaksi.id', $id)
            ->first();

        if (!$transaksi) {
            abort(404);
        }

        $saldo = DB::table('saldo')->where('id', $transaksi->saldo_id)->first();

        if (!$saldo) {
            abort(404);
        }

        $saldo_terdampak = DB::table('saldo')->where('id', '>', $saldo->id)->get();

        foreach ($saldo_terdampak as $item) {
            if ($transaksi->kategori == 'pembentukan' || $transaksi->kategori == 'pemasukan') {
                DB::table('saldo')->where('id', $item->id)->update([
                    'total' => $item->total - $transaksi->jumlah,
                ]);
            } elseif ($transaksi->kategori == 'pengeluaran') {
                DB::table('saldo')->where('id', $item->id)->update([
                    'total' => $item->total + $transaksi->jumlah,
                ]);
            }
        }

        $transaksi = DB::table('transaksi')->where('saldo_id', $saldo->id)->delete();
        if ($transaksi) {
            DB::table('saldo')->where('id', $saldo->id)->delete();
            return redirect()->back()->with('success', "Data berhasil dihapus");
        } else {
            return redirect()->back()->with('error', "Data gagal dihapus");
        }
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

            $pdf = FacadePdf::loadView('pages.transaksi.pembentukan.laporan_pdf', [
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
