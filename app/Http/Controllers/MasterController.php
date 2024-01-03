<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\select;

class MasterController extends Controller
{

    // BAGIAN AKUN AAS
    public function indexaas()
    {
        $aas = DB::table('akun_aas')
            ->orderBy('kode_aas', 'ASC')
            ->get();
        return view('master.index_aas', compact('aas'));
    }

    public function storeaas(Request $request)
    {
        $kode_aas = $request->kode_aas;
        $nama_aas = $request->nama_aas;
        $status = $request->status;
        $kategori = $request->kategori;

        try {
            $data = [
                'kode_aas' => $kode_aas,
                'nama_aas' => $nama_aas,
                'status' => $status,
                'kategori' => $kategori

            ];

            $simpan = DB::table('akun_aas')->insert($data);
            if ($simpan) {
                echo 'success|Data disimpan';
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            echo 'error|Maaf data tidak tersimpan';
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    public function editaas(Request $request)
    {
        $id = $request->id;
        $aas = DB::table('akun_aas')->where('id', $id)->first();
        return view('master.editaas', compact('aas'));
    }

    public function updateaas($id, Request $request)
    {

        $kode_aas = $request->kode_aas;
        $nama_aas = $request->nama_aas;
        $status = $request->status;
        $kategori = $request->kategori;

        try {
            $data = [
                'kode_aas' => $kode_aas,
                'nama_aas' => $nama_aas,
                'status' => $status,
                'kategori' => $kategori

            ];

            $update = DB::table('akun_aas')->where('id', $id)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal diupdate']);
        }
    }

    public function deleteaas($id)
    {
        $hapus = DB::table('akun_aas')->where('id', $id)->delete();
        if ($hapus) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data  Gagal Dihapus']);
        }
    }


    // BAGIAN MATA ANGGARAN

    public function indexmatanggaran()
    {
        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas')
            ->orderBy('kode_aas', 'ASC')
            ->get();

        $aas = DB::table('akun_aas')
            ->orderBy('kode_aas', 'ASC')
            ->get();
        return view('master.index_matanggaran', compact('matanggaran', 'aas'));
    }

    public function storematanggaran(Request $request)
    {
        $kode_matanggaran = $request->kode_matanggaran;
        $kode_aas = $request->kode_aas;
        $saldo_matanggaran = $request->saldo_matanggaran;
        // Membersihkan tanda koma dari $request->jumlah
        $saldo_cleaned = str_replace(['.', ','], '', $saldo_matanggaran);
        // Konversi ke integer
        $saldo_numeric = intval($saldo_cleaned);


        try {
            $data = [
                'kode_matanggaran' => $kode_matanggaran,
                'saldo' => $saldo_numeric,
                'kode_aas' => $kode_aas

            ];
            $simpan = DB::table('akun_matanggaran')->insert($data);
            if ($simpan) {
                echo 'success|Data disimpan';
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            echo 'error|Data gagal disimpan';
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    public function editmatanggaran(Request $request)
    {
        $id = $request->id;
        $matanggaran = DB::table('akun_matanggaran')
            ->leftJoin('akun_aas', 'akun_matanggaran.kode_aas', '=', 'akun_aas.kode_aas')
            ->select('akun_matanggaran.*', 'akun_aas.nama_aas')
            ->orderBy('kode_aas', 'ASC')
            ->where('akun_matanggaran.id', $id)
            ->first();
        $aas = DB::table('akun_aas')
            ->orderBy('kode_aas', 'ASC')
            ->get();

        return view('master.editmatanggaran', compact('matanggaran', 'aas'));
    }

    public function updatematanggaran($id, Request $request)
    {



        $kode_matanggaran = $request->kode_matanggaran;
        $kode_aas = $request->kode_aas;
        $saldo_matanggaran = $request->saldo_matanggaran;
        // Membersihkan tanda koma dari $request->jumlah
        $saldo_cleaned = str_replace(['.', ','], '', $saldo_matanggaran);
        // Konversi ke integer
        $saldo_numeric = intval($saldo_cleaned);

        try {
            $data = [
                'kode_matanggaran' => $kode_matanggaran,
                'kode_aas' => $kode_aas,
                'saldo' => $saldo_numeric

            ];

            $update = DB::table('akun_matanggaran')->where('id', $id)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(['warning' => 'Data gagal diupdate']);
        }
    }

    public function deletematanggaran($id)
    {
        $hapus = DB::table('akun_matanggaran')->where('id', $id)->delete();
        if ($hapus) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data  Gagal Dihapus']);
        }
    }
}
