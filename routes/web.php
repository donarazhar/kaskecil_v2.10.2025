<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});


Route::middleware(['auth:user'])->group(
    function () {
        Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/panel/beranda', [PageController::class, 'beranda']);

        // User
        Route::resource('users', UserController::class)->only('index', 'create', 'destroy', 'store', 'update', 'edit');
        Route::get('/users/{user}/reset-password', [UserController::class, 'resetPassword']);
        Route::put('/users/{user}/update-password', [UserController::class, 'updatePassword']);

        // Akun AAS
        Route::get('/master/aas', [MasterController::class, 'indexaas']);
        Route::post('/master/storeaas', [MasterController::class, 'storeaas']);
        Route::post('/master/editaas', [MasterController::class, 'editaas']);
        Route::post('/master/aas/{id}/updateaas', [MasterController::class, 'updateaas']);
        Route::post('/master/aas/{id}/deleteaas', [MasterController::class, 'deleteaas']);

        // Akun Mata Anggaran
        Route::get('/master/matanggaran', [MasterController::class, 'indexmatanggaran']);
        Route::post('/master/storematanggaran', [MasterController::class, 'storematanggaran']);
        Route::post('/master/editmatanggaran', [MasterController::class, 'editmatanggaran']);
        Route::post('/master/matanggaran/{id}/updatematanggaran', [MasterController::class, 'updatematanggaran']);
        Route::post('/master/matanggaran/{id}/deletematanggaran', [MasterController::class, 'deletematanggaran']);

        // Transaksi
        Route::resource('transaksi', TransaksiController::class)->only('index', 'store', 'update', 'destroy', 'cari');
        Route::get('/transaksi/pembentukan', [TransaksiController::class, 'indexPembentukan'])->name('transaksi.pembentukan.index');
        Route::get('/transaksi/pembentukan/create', [TransaksiController::class, 'createPembentukan'])->name('transaksi.pembentukan.create');
        Route::get('/transaksi/pengeluaran', [TransaksiController::class, 'indexPengeluaran'])->name('transaksi.pengeluaran.index');
        Route::get('/transaksi/pengeluaran/create', [TransaksiController::class, 'createPengeluaran'])->name('transaksi.pengeluaran.create');
        Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
        Route::post('/transaksi/laporan/download', [TransaksiController::class, 'laporanPDF'])->name('transaksi.download');

        //Instansi
        Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.index');
        Route::get('/instansi/{id}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
        Route::put('/instansi/{id}', [InstansiController::class, 'update'])->name('instansi.update');
    }
);
