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
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencegah Brute Force Login
        $throttleKey = strtolower($request->input('email')) . '|' . $request->ip();
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
            return redirect('/panel')->with(['warning' => 'Terlalu banyak percobaan. Coba lagi dalam ' . $seconds . ' detik.']);
        }

        // Coba otentikasi pengguna dengan guard 'user' menggunakan email dan password.
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            \Illuminate\Support\Facades\RateLimiter::clear($throttleKey);
            // Jika berhasil, alihkan ke beranda panel.
            return redirect('/panel/beranda');
        } else {
            \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 60); // Blokir 1 menit setelah 5x gagal
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
