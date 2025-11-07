<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstansiRequest;
use App\Models\Instansi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InstansiController extends Controller
{
    // Menampilkan halaman utama data instansi.
    public function index()
    {
        // Mengambil data instansi pertama dari database.
        $instansi = Instansi::first();
        // Menampilkan view dan mengirimkan data instansi.
        return view('pages.instansi.index', ['instansi' => $instansi]);
    }

    // Menampilkan halaman untuk mengedit data instansi.
    public function edit($id)
    {
        // Otorisasi (dinonaktifkan).
        // $this->authorize('isAdmin', Instansi::class);
        // Mencari data instansi berdasarkan ID, gagal jika tidak ditemukan.
        $instansi = Instansi::findOrFail($id);
        // Menampilkan view edit dengan data instansi yang akan diubah.
        return view('pages.instansi.edit', ['instansi' => $instansi]);
    }

    // Memperbarui data instansi di database.
    public function update(InstansiRequest $request, $id)
    {
        // Mencari data instansi berdasarkan ID.
        $instansi = Instansi::findOrFail($id);
        // Memperbarui data instansi dengan data dari request.
        $instansi->update($request->all());
        // Menampilkan notifikasi sukses.
        Alert::success('Sukses', 'Profile instansi berhasil diupdate');
        // Mengalihkan kembali ke halaman index instansi.
        return redirect()->route('instansi.index');
    }
}
