<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\TryCatch;

class TransaksiController extends Controller
{
    // Index Menu Home Transaksi
    public function index()
    {
        $transaksi = DB::table('transaksi')
            ->select('transaksi.*', 'akun_aas.*', 'akun_matanggaran.*')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
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

            // Membersihkan tanda koma dari $request->jumlah
            $jumlah_cleaned = str_replace(['.', ','], '', $request->jumlah);
            // Konversi ke integer
            $jumlah_numeric = intval($jumlah_cleaned);

            // Validasi untuk file yang diupload
            $request->validate([
                'lampiran' => 'nullable|image|mimes:png,jpg,jpeg|max:2024',
                'lampiran2' => 'nullable|image|mimes:png,jpg,jpeg|max:2024',
                'lampiran3' => 'nullable|image|mimes:png,jpg,jpeg|max:2024'
            ]);
            // Proses Upload Foto
            if ($request->hasFile('lampiran')) {
                $lampiran = 'lampiran_' . now()->format('YmdHis') . '_1.' . $request->file('lampiran')->getClientOriginalExtension();
                $request->file('lampiran')->storeAs('public/uploads/lampiran/img/', $lampiran);
            }

            if ($request->hasFile('lampiran2')) {
                $lampiran2 = 'lampiran_' . now()->format('YmdHis') . '_2.' . $request->file('lampiran2')->getClientOriginalExtension();
                $request->file('lampiran2')->storeAs('public/uploads/lampiran/img/', $lampiran2);
            }

            if ($request->hasFile('lampiran3')) {
                $lampiran3 = 'lampiran_' . now()->format('YmdHis') . '_3.' . $request->file('lampiran3')->getClientOriginalExtension();
                $request->file('lampiran3')->storeAs('public/uploads/lampiran/img/', $lampiran3);
            }



            // Insert data transaksi dengan ID saldo yang baru saja dibuat
            DB::table('transaksi')->insert([

                'jumlah' => $jumlah_numeric,
                'lampiran' => $lampiran ?? null,
                'lampiran2' => $lampiran2 ?? null,
                'lampiran3' => $lampiran3 ?? null,
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


        return redirect()->back()->with('pesan', 'Update transaksi berhasil');
    }

    // Hapus pembentukan
    public function hapuspembentukan($id)
    {
        $transaksi = DB::table('transaksi')
            ->select('transaksi.*')
            ->where('transaksi.id', $id)
            ->first();

        $transaksi = DB::table('transaksi')->where('id', $transaksi->id)->delete();
        if ($transaksi) {
            return redirect()->back()->with('success', "Data berhasil dihapus");
        } else {
            return redirect()->back()->with('error', "Data gagal dihapus");
        }
    }

    // MENU PENGELUARAN KAS KECIL
    // Index Menu Pengeluaran Kas Kecil
    public function indexPengeluaran(Request $request)
    {
        $hariini = date("Y-m-d");
        $bulanini = date("m");
        $tahunini = date("Y");
        $pengeluaran = "pengeluaran";

        // Menangani pencarian
        $bulan = $request->input('bulan', $bulanini);
        $tahun = $request->input('tahun', $tahunini);

        $pengeluaranbulanini = DB::table('transaksi')
            ->select('transaksi.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi.kategori', $pengeluaran)
            ->whereRaw('MONTH(tanggal)="' . $bulan . '"')
            ->whereRaw('YEAR(tanggal)="' . $tahun . '"')
             ->orderBy('tanggal', 'ASC')
            ->get();

        $tanggal_sekarang = Date::now();
        $bulan_sekarang = $tanggal_sekarang->format('m');

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
            ->whereRaw('MONTH(tanggal)="' . $bulan . '"')
            ->whereRaw('YEAR(tanggal)="' . $tahun . '"')
            ->first();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('pages.transaksi.pengeluaran.index', compact('namabulan', 'matanggaran', 'totalpengeluaran', 'pengeluaranbulanini', 'bulan', 'tahun'));
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

    // Edit Menu Pengeluaran Kas Kecil
    public function lihatLampiran(Request $request)
    {

        $id = $request->id;
        $transaksi = DB::table('transaksi')->where('id', $id)->first();

        return view('pages.transaksi.pengeluaran.lihat', compact('transaksi'));
    }

    // Update Menu Pengeluaran Kas Kecil
    public function updatePengeluaran($id, Request $request)
    {
        $jumlah_cleaned = str_replace(['.', ','], '', $request->jumlah);

        // Validasi untuk file yang diupload
        $request->validate([
            'lampiran' => 'nullable|image|mimes:png,jpg,jpeg|max:2024',
            'lampiran2' => 'nullable|image|mimes:png,jpg,jpeg|max:2024',
            'lampiran3' => 'nullable|image|mimes:png,jpg,jpeg|max:2024'
        ]);

        // Ambil data transaksi berdasarkan ID
        $transaksi = DB::table('transaksi')->where('id', $id)->first();

        // Proses Upload Foto hanya jika file diupload
        $lampiran = $transaksi->lampiran;
        $lampiran2 = $transaksi->lampiran2;
        $lampiran3 = $transaksi->lampiran3;

        if ($request->hasFile('lampiran')) {
            $lampiran = 'lampiran_' . now()->format('YmdHis') . '_1.' . $request->file('lampiran')->getClientOriginalExtension();
            $request->file('lampiran')->storeAs('public/uploads/lampiran/img/', $lampiran);
        }

        if ($request->hasFile('lampiran2')) {
            $lampiran2 = 'lampiran_' . now()->format('YmdHis') . '_2.' . $request->file('lampiran2')->getClientOriginalExtension();
            $request->file('lampiran2')->storeAs('public/uploads/lampiran/img/', $lampiran2);
        }

        if ($request->hasFile('lampiran3')) {
            $lampiran3 = 'lampiran_' . now()->format('YmdHis') . '_3.' . $request->file('lampiran3')->getClientOriginalExtension();
            $request->file('lampiran3')->storeAs('public/uploads/lampiran/img/', $lampiran3);
        }

        // Update data transaksi
        $data = [
            'kode_matanggaran' => $request->kode_matanggaran,
            'jumlah' => $jumlah_cleaned,
            'lampiran' => $lampiran,
            'lampiran2' => $lampiran2,
            'lampiran3' => $lampiran3,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'perincian' => $request->perincian,
        ];

        DB::table('transaksi')
            ->where('id', $id)
            ->update($data);

        return redirect()->back()->with('pesan', 'Update transaksi berhasil');
    }


    // Hapus pengeluaran
    public function hapuspengeluaran($id)
    {
        $transaksi = DB::table('transaksi')
            ->select('transaksi.*')
            ->where('transaksi.id', $id)
            ->first();

        $transaksi = DB::table('transaksi')->where('id', $transaksi->id)->delete();
        if ($transaksi) {

            return redirect()->back()->with('success', "Data berhasil dihapus");
        } else {
            return redirect()->back()->with('error', "Data gagal dihapus");
        }
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

        $pengisianShadow = DB::table('transaksi_shadow')
            ->select('transaksi_shadow.*', 'akun_matanggaran.kode_aas', 'akun_aas.nama_aas', 'akun_aas.status')
            ->leftJoin('akun_matanggaran', 'transaksi_shadow.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi_shadow.kategori', '=', 'pengisian')
            ->orderBy('transaksi_shadow.created_at', 'ASC')
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

        $combinedData = $pengisian->merge($pengisianShadow);
        $idPengisianArray = $combinedData->pluck('id_pengisian')->all();


        return view('pages.transaksi.pengisian.index', compact('pengisian', 'matanggaran', 'totalpengisian', 'pengisianShadow', 'idPengisianArray', 'combinedData'));
    }

    // Edit Menu Pengisian Kas Kecil
    public function editPengisian(Request $request)
    {
        $id = $request->id;
        $transaksi = DB::table('transaksi_shadow')->where('id_pengisian', $id)->first();
        $pengisian = DB::table('transaksi_shadow')
            ->select('transaksi_shadow.*', 'akun_matanggaran.kode_matanggaran', 'akun_aas.nama_aas')
            ->leftJoin('akun_matanggaran', 'transaksi_shadow.kode_matanggaran', '=', 'akun_matanggaran.kode_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->where('transaksi_shadow.id_pengisian', $id)
            ->first();

        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas', 'akun_aas.status', 'akun_aas.kategori')
            ->orderBy('kode_aas', 'ASC')
            ->get();

        return view('pages.transaksi.pengisian.edit', compact('transaksi', 'pengisian', 'matanggaran'));
    }


    // Update Menu Pengeluaran Kas Kecil
    public function storePengisian(Request $request)
    {
        $pengisian = "pengisian";
        // Combine the results from both queries
        $id_pengisian = DB::table('transaksi')
            ->where('kategori', $pengisian)
            ->select('id_pengisian')
            ->unionAll(DB::table('transaksi_shadow')
                ->where('kategori', $pengisian)
                ->select('id_pengisian'))
            ->get();
        // Get the new transaction number
        if (count($id_pengisian) == 0) {
            $nomorUrutBaru = 1;
        } else {
            $nomorUrutTerakhir = $id_pengisian->max('id_pengisian');
            $nomorUrutBaru = $nomorUrutTerakhir + 1;
        }

        $jumlah_cleaned = str_replace(['.', ','], '', $request->jumlah);

        $data = [
            'id_pengisian' => $nomorUrutBaru,
            'jumlah' => $jumlah_cleaned,
            'perincian' => $request->perincian,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'kode_matanggaran' => $request->kode_matanggaran,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('transaksi_shadow')
            ->insert($data);

        return redirect()->back()->with('success', 'Update transaksi berhasil');
    }
    // Update Menu Pengeluaran Kas Kecil
    public function updatePengisian($id, Request $request)
    {
        $transaksi = DB::table('transaksi_shadow')->where('id_pengisian', $id)->first();
        $jumlah_cleaned = str_replace(['.', ','], '', $request->jumlah);
        $data = [
            'jumlah' => $jumlah_cleaned,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'perincian' => $request->perincian,
        ];

        DB::table('transaksi_shadow')
            ->where('id_pengisian', $id)
            ->update($data);

        return redirect()->back()->with('success', 'Update transaksi berhasil');
    }

    // Cetak Surat Pengisian Kas Kecil
    public function cetakPengisian(Request $request)
    {
        $id = $request->id;
        $transaksi = DB::table('transaksi_shadow')->where('id_pengisian', $id)->first();
        $instansi = DB::table('instansi')->get();
        return view('pages.transaksi.pengisian.cetakum', compact('transaksi', 'instansi'));
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
        $transaksi = DB::table('transaksi_shadow')
            ->select('transaksi_shadow.*')
            ->where('transaksi_shadow.id_pengisian', $id)
            ->first();

        if (!$transaksi) {
            abort(404);
        }

        $transaksi = DB::table('transaksi_shadow')->where('id_pengisian', $transaksi->id_pengisian)->delete();
        if ($transaksi) {

            return redirect()->back()->with('success', "Data berhasil dihapus");
        } else {
            return redirect()->back()->with('error', "Data gagal dihapus");
        }
    }

    public function cair($id)
    {

        // Mendapatkan data transaksi yang akan dipindahkan
        $transaksiShadowData = DB::table('transaksi_shadow')
            ->select('transaksi_shadow.*')
            ->where('id_pengisian', $id)
            ->first();

        if ($transaksiShadowData) {
            // Proses insert ke tabel progress_shadow
            DB::table('transaksi')->insert([
                'id_pengisian' => $transaksiShadowData->id_pengisian,
                'perincian' => $transaksiShadowData->perincian,
                'kategori' => $transaksiShadowData->kategori,
                'jumlah' => $transaksiShadowData->jumlah,
                'kode_matanggaran' => $transaksiShadowData->kode_matanggaran,
                'tanggal' => $transaksiShadowData->tanggal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Proses hapus data dari tabel progress
            DB::table('transaksi_shadow')->where('id_pengisian', $id)->delete();
            // Redirect atau lakukan operasi lain sesuai kebutuhan
            return Redirect::back()->with(['success' => 'Data anda sudah cair !!!']);
        } else {
            // Data progress tidak ditemukan, mungkin ada penanganan khusus yang perlu dilakukan
            return Redirect::back()->with(['error' => 'Data tidak ditemukan.']);
        }
    }
}
