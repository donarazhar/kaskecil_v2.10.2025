<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // Fungsi untuk memproses login admin.
    public function proseslogin(Request $request)
    {
        // Coba otentikasi pengguna dengan guard 'user' menggunakan email dan password.
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika berhasil, alihkan ke beranda panel.
            return redirect('/panel/beranda');
        } else {
            // Jika gagal, kembali ke halaman login dengan pesan error.
            return redirect('/panel')->with(['warning' => 'Username / Password Salah']);
        }
    }

    // Fungsi untuk memproses logout admin.
    public function proseslogout()
    {
        // Periksa apakah pengguna sudah login dengan guard 'user'.
        if (Auth::guard('user')->check()) {
            // Logout pengguna dari guard 'user'.
            Auth::guard('user')->logout();
            // Alihkan kembali ke halaman login panel.
            return redirect('/panel');
        }
    }
}
