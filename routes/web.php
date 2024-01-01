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

        // Pembentukan Kas Kecil
        Route::resource('transaksi', TransaksiController::class)->only('index', 'store', 'destroy', 'cari');
        Route::get('/transaksi/pembentukan', [TransaksiController::class, 'indexPembentukan']);
        Route::post('/transaksi/pembentukan/edit', [TransaksiController::class, 'editPembentukan']);
        Route::post('/transaksi/pembentukan/{id}/update', [TransaksiController::class, 'updatePembentukan']);

        // Pengeluaran Kas Kecil
        Route::get('/transaksi/pengeluaran', [TransaksiController::class, 'indexPengeluaran']);
        Route::post('/transaksi/pengeluaran/edit', [TransaksiController::class, 'editPengeluaran']);
        Route::post('/transaksi/pengeluaran/{id}/update', [TransaksiController::class, 'updatePengeluaran']);

        // Pengisian Kas Kecil
        Route::get('/transaksi/pengisian', [TransaksiController::class, 'indexPengisian']);
        Route::post('/transaksi/pengisian/edit', [TransaksiController::class, 'editindexPengisian']);
        Route::post('/transaksi/pengisian/{id}/update', [TransaksiController::class, 'updateindexPengisian']);


        Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan']);
        Route::post('/transaksi/laporan/download', [TransaksiController::class, 'laporanPDF']);

        //Instansi
        Route::get('/instansi', [InstansiController::class, 'index']);
        Route::get('/instansi/{id}/edit', [InstansiController::class, 'edit']);
        Route::put('/instansi/{id}', [InstansiController::class, 'update']);
    }
);
