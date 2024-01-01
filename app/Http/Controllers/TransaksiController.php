<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class TransaksiController extends Controller
{
    // Index Menu Home Transaksi
    public function index()
    {
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


        return view('pages.transaksi.index', compact('transaksi', 'total_pembentukan', 'total_pengisian', 'total_pengeluaran', 'total_pengeluaran', 'total_result'));
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

    // MENU PEMBENTUKAN KAS KECIL
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
        $jumlah_cleaned = str_replace(['.', ','], '', $request->jumlah);
        $data = [
            'jumlah' => $jumlah_cleaned,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'perincian' => $request->perincian,
        ];

        DB::table('transaksi')
            ->where('id', $id)
            ->update($data);

        $saldo_id = $transaksi->saldo_id;
        $saldo_total = DB::table('saldo')
            ->where('id', $saldo_id)
            ->value('total');

        if ($jumlah_cleaned > $transaksi->jumlah) {
            $saldo_total += ($jumlah_cleaned - $transaksi->jumlah);
        } else if ($jumlah_cleaned < $transaksi->jumlah) {
            $saldo_total -= ($transaksi->jumlah -   $jumlah_cleaned);
        }

        DB::table('saldo')
            ->where('id', $saldo_id)
            ->update(['total' => $saldo_total]);

        return redirect()->back()->with('pesan', 'Update transaksi berhasil');
    }


    // MENU PENGELUARAN KAS KECIL
    // Index Menu Pengeluaran Kas Kecil
    public function indexPengeluaran()
    {

        $tanggal_sekarang = Date::now();
        $bulan_sekarang = $tanggal_sekarang->format('m');

        $pengeluaran = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', '=', 'pengeluaran')
            ->orderBy('transaksi.created_at', 'ASC')
            ->get();

        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas', 'akun_aas.status', 'akun_aas.kategori')
            ->orderBy('kode_aas', 'ASC')
            ->get();

        $totalpengeluaran = DB::table('transaksi')
            ->select(
                DB::raw('SUM(jumlah) AS total_pengeluaran')
            )
            ->where('kategori', 'pengeluaran')
            ->whereMonth('tanggal', $bulan_sekarang)
            ->first();

        return view('pages.transaksi.pengeluaran.index', compact('pengeluaran', 'matanggaran', 'totalpengeluaran'));
    }

    // Edit Menu Pengeluaran Kas Kecil
    public function editPengeluaran(Request $request)
    {
        $id = $request->id;
        $transaksi = DB::table('transaksi')->where('id', $id)->first();
        $pengeluaran = DB::table('transaksi')
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

        return view('pages.transaksi.pengeluaran.edit', compact('transaksi', 'pengeluaran', 'matanggaran'));
    }

    // Update Menu Pengeluaran Kas Kecil
    public function updatePengeluaran($id, Request $request)
    {
        $transaksi = DB::table('transaksi')->where('id', $id)->first();
        $jumlah_cleaned = str_replace(['.', ','], '', $request->jumlah);
        $data = [
            'jumlah' => $jumlah_cleaned,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'perincian' => $request->perincian,
        ];

        DB::table('transaksi')
            ->where('id', $id)
            ->update($data);

        $saldo_id = $transaksi->saldo_id;
        $saldo_total = DB::table('saldo')
            ->where('id', $saldo_id)
            ->value('total');

        if ($jumlah_cleaned > $transaksi->jumlah) {
            $saldo_total += ($jumlah_cleaned - $transaksi->jumlah);
        } else if ($jumlah_cleaned < $transaksi->jumlah) {
            $saldo_total -= ($transaksi->jumlah -   $jumlah_cleaned);
        }

        DB::table('saldo')
            ->where('id', $saldo_id)
            ->update(['total' => $saldo_total]);

        return redirect()->back()->with('pesan', 'Update transaksi berhasil');
    }


    // MENU PENGISIAN KAS KECIL
    // Index Menu Pengisian Kas Kecil
    public function indexPengisian()
    {

        $tanggal_sekarang = Date::now();
        $bulan_sekarang = $tanggal_sekarang->format('m');

        $pengisian = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', '=', 'pengisian')
            ->orderBy('transaksi.created_at', 'ASC')
            ->get();

        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas', 'akun_aas.status', 'akun_aas.kategori')
            ->orderBy('kode_aas', 'ASC')
            ->get();

        $totalpengisian = DB::table('transaksi')
            ->select(
                DB::raw('SUM(jumlah) AS total_pengisian')
            )
            ->where('kategori', 'pengisian')
            ->whereMonth('tanggal', $bulan_sekarang)
            ->first();

        return view('pages.transaksi.pengisian.index', compact('pengisian', 'matanggaran', 'totalpengisian'));
    }

    // Edit Menu Pengisian Kas Kecil
    public function editPengisian(Request $request)
    {
        $id = $request->id;
        $transaksi = DB::table('transaksi')->where('id', $id)->first();
        $pengisian = DB::table('transaksi')
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

        return view('pages.transaksi.pengisian.edit', compact('transaksi', 'pengisian', 'matanggaran'));
    }

    // Update Menu Pengeluaran Kas Kecil
    public function updatePengisian($id, Request $request)
    {
        $transaksi = DB::table('transaksi')->where('id', $id)->first();
        $jumlah_cleaned = str_replace(['.', ','], '', $request->jumlah);
        $data = [
            'jumlah' => $jumlah_cleaned,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'perincian' => $request->perincian,
        ];

        DB::table('transaksi')
            ->where('id', $id)
            ->update($data);

        $saldo_id = $transaksi->saldo_id;
        $saldo_total = DB::table('saldo')
            ->where('id', $saldo_id)
            ->value('total');

        if ($jumlah_cleaned > $transaksi->jumlah) {
            $saldo_total += ($jumlah_cleaned - $transaksi->jumlah);
        } else if ($jumlah_cleaned < $transaksi->jumlah) {
            $saldo_total -= ($transaksi->jumlah -   $jumlah_cleaned);
        }

        DB::table('saldo')
            ->where('id', $saldo_id)
            ->update(['total' => $saldo_total]);

        return redirect()->back()->with('pesan', 'Update transaksi berhasil');
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
