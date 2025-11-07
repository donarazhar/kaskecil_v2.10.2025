<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\select;

class MasterController extends Controller
{
    // --- BAGIAN AKUN AAS ---

    // Menampilkan daftar Akun AAS dengan paginasi dan fitur pencarian.
    public function indexaas(Request $request)
    {
        // Query untuk mengambil data akun AAS dengan filter pencarian berdasarkan nama.
        $aas = DB::table('akun_aas')
            ->select('akun_aas.*')
            ->where(function ($query) use ($request) {
                if (!empty($request->nama_akunaas)) {
                    $query->where('nama_aas', 'like', '%' . $request->nama_akunaas . '%');
                }
            })
            ->paginate(10);

        // Menampilkan view index AAS dan mengirimkan data.
        return view('master.index_aas', compact('aas'));
    }

    // Menyimpan data Akun AAS baru ke database.
    public function storeaas(Request $request)
    {
        // Mengambil data dari request.
        $kode_aas = $request->kode_aas;
        $nama_aas = $request->nama_aas;
        $status = $request->status;
        $kategori = $request->kategori;

        try {
            // Menyiapkan array data untuk disimpan.
            $data = [
                'kode_aas' => $kode_aas,
                'nama_aas' => $nama_aas,
                'status' => $status,
                'kategori' => $kategori
            ];

            // Menyimpan data dan memberikan respon sukses.
            $simpan = DB::table('akun_aas')->insert($data);
           
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            // Memberikan respon gagal jika terjadi error.
          return Redirect::back()->with(['warning' => 'Data gagal disimpan: ' . $e->getMessage()]);
        }
    }

    // Menampilkan form edit untuk Akun AAS.
    public function editaas(Request $request)
    {
        $id = $request->id;
        // Mengambil data AAS berdasarkan ID untuk ditampilkan di form.
        $aas = DB::table('akun_aas')->where('id', $id)->first();
        return view('master.editaas', compact('aas'));
    }

    // Memperbarui data Akun AAS di database.
    public function updateaas($id, Request $request)
    {
        // Mengambil data dari request.
        $kode_aas = $request->kode_aas;
        $nama_aas = $request->nama_aas;
        $status = $request->status;
        $kategori = $request->kategori;

        try {
            // Menyiapkan data untuk diupdate.
            $data = [
                'kode_aas' => $kode_aas,
                'nama_aas' => $nama_aas,
                'status' => $status,
                'kategori' => $kategori
            ];

            // Mengupdate data dan memberikan respon sukses.
            $update = DB::table('akun_aas')->where('id', $id)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            // Memberikan respon gagal jika terjadi error.
            return Redirect::back()->with(['warning' => 'Data gagal diupdate']);
        }
    }

    // Menghapus data Akun AAS dari database.
    public function deleteaas($id)
    {
        $hapus = DB::table('akun_aas')->where('id', $id)->delete();
        // Memberikan respon berdasarkan hasil proses hapus.
        if ($hapus) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data  Gagal Dihapus']);
        }
    }

    // --- BAGIAN MATA ANGGARAN ---

    // Menampilkan daftar Mata Anggaran dengan paginasi dan data relasi.
    public function indexmatanggaran(Request $request)
    {
        // Mengambil data mata anggaran dengan join ke akun AAS.
        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas')
            ->when(!empty($request->nama_akunaas), function ($query) use ($request) {
                return $query->where('nama_aas', 'like', '%' . $request->nama_akunaas . '%');
            })
            ->orderBy('akun_matanggaran.kode_aas', 'ASC')
            ->paginate(10);

        // Mengambil semua akun AAS untuk dropdown.
        $aas = DB::table('akun_aas')
            ->orderBy('kode_aas', 'ASC')
            ->get();
        return view('master.index_matanggaran', compact('matanggaran', 'aas'));
    }

    // Menyimpan data Mata Anggaran baru.
    public function storematanggaran(Request $request)
    {
        // Mengambil data dan membersihkan format angka.
        $kode_matanggaran = $request->kode_matanggaran;
        $kode_aas = $request->kode_aas;
        $saldo_matanggaran = $request->saldo_matanggaran;
        $saldo_cleaned = str_replace(['.', ','], '', $saldo_matanggaran);
        $saldo_numeric = intval($saldo_cleaned);

        try {
            // Menyiapkan data untuk disimpan.
            $data = [
                'kode_matanggaran' => $kode_matanggaran,
                'saldo' => $saldo_numeric,
                'kode_aas' => $kode_aas
            ];
            // Menyimpan data dan memberikan respon.
            $simpan = DB::table('akun_matanggaran')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
           return Redirect::back()->with(['warning' => 'Data gagal disimpan: ' . $e->getMessage()]);

        }
    }

    // Menampilkan form edit untuk Mata Anggaran.
    public function editmatanggaran(Request $request)
    {
        $id = $request->id;
        // Mengambil data mata anggaran dan akun AAS terkait.
        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas')
            ->orderBy('kode_aas', 'ASC')
            ->where('akun_matanggaran.id', $id)
            ->first();
        $aas = DB::table('akun_aas')
            ->orderBy('kode_aas', 'ASC')
            ->get();

        // Menampilkan view edit dengan data yang diperlukan.
        return view('master.editmatanggaran', compact('matanggaran', 'aas'));
    }

    // Memperbarui data Mata Anggaran.
    public function updatematanggaran($id, Request $request)
    {
        // Mengambil data dan membersihkan format angka.
        $kode_matanggaran = $request->kode_matanggaran;
        $kode_aas = $request->kode_aas;
        $saldo_matanggaran = $request->saldo_matanggaran;
        $saldo_cleaned = str_replace(['.', ','], '', $saldo_matanggaran);
        $saldo_numeric = intval($saldo_cleaned);

        try {
            // Menyiapkan data untuk diupdate.
            $data = [
                'kode_matanggaran' => $kode_matanggaran,
                'kode_aas' => $kode_aas,
                'saldo' => $saldo_numeric
            ];

            // Mengupdate data dan memberikan respon.
            $update = DB::table('akun_matanggaran')->where('id', $id)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal diupdate']);
        }
    }

    // Menghapus data Mata Anggaran.
    public function deletematanggaran($id)
    {
        $hapus = DB::table('akun_matanggaran')->where('id', $id)->delete();
        // Memberikan respon berdasarkan hasil proses hapus.
        if ($hapus) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data  Gagal Dihapus']);
        }
    }
}
