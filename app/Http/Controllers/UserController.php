<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    // Menampilkan halaman utama daftar pengguna.
    public function index()
    {
        // Mengambil semua data pengguna dari database.
        $users = DB::table('users')->get();
        // Menampilkan view dan mengirimkan data pengguna.
        return view('pages.users.index', compact('users'));
    }

    // Menyimpan data pengguna baru ke dalam database.
    public function store(Request $request)
    {
        // Mengambil data dari request.
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        try {
            // Enkripsi kata sandi sebelum disimpan.
            $hashedPassword = Hash::make($password);

            // Menyiapkan data untuk dimasukkan ke database.
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
            ];

            // Menyimpan data dan memberikan respon sukses.
            $simpan = DB::table('users')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            // Memberikan respon gagal jika terjadi error.
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    // Menampilkan halaman untuk mengedit data pengguna.
    public function edit(Request $request)
    {
        // Mencari pengguna berdasarkan ID.
        $id = $request->id;
        $users = DB::table('users')->where('id', $id)->first();
        // Menampilkan view edit dengan data pengguna yang akan diubah.
        return view('pages.users.edit', compact('users'));
    }

    // Memperbarui data pengguna di dalam database.
    public function update(Request $request, $id)
    {
        // Mengambil data dari request.
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        try {
            // Enkripsi kata sandi baru.
            $hashedPassword = Hash::make($password);

            // Menyiapkan data untuk diupdate.
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
            ];

            // Memperbarui data dan memberikan respon sukses.
            $update = DB::table('users')->where('id', $id)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            // Memberikan respon gagal jika terjadi error.
            return Redirect::back()->with(['warning' => 'Data gagal diupdate']);
        }
    }

    // Menghapus data pengguna dari database.
    public function destroy($id)
    {
        try {
            // Mencari pengguna berdasarkan ID.
            $user = DB::table('users')->where('id', $id)->first();

            if ($user) {
                // Menghapus pengguna jika ditemukan.
                $delete = DB::table('users')->where('id', $id)->delete();

                if ($delete) {
                    return Redirect::back()->with(['success' => 'Data berhasil dihapus']);
                } else {
                    return Redirect::back()->with(['warning' => 'Data gagal dihapus']);
                }
            } else {
                return Redirect::back()->with(['warning' => 'User tidak ditemukan']);
            }
        } catch (\Exception $e) {
            // Memberikan respon jika terjadi kesalahan saat proses hapus.
            return Redirect::back()->with(['warning' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Menampilkan halaman untuk mereset kata sandi pengguna.
    public function resetPassword($id)
    {
        // Otorisasi (dinonaktifkan).
        // $this->authorize('isAdmin', User::class);
        // Mencari pengguna berdasarkan ID.
        $user = DB::table('users')->where('id', $id)->first();
        // Menampilkan view reset password.
        return view('pages.users.reset_password', ['user' => $user]);
    }

    // Memperbarui kata sandi pengguna di database.
    public function UpdatePassword(Request $request, $id)
    {
        // Mencari pengguna dan memperbarui kata sandi.
        $user = DB::table('users')->where('id', $id)->first();
        $user->update([
            'password' => $request->kata_sandi_baru,
        ]);

        // Menampilkan notifikasi sukses dan mengalihkan kembali.
        Alert::success('Sukses', "Kata sandi {$user->email} sukses direset");
        return redirect()->back();
    }
}
