<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstansiController;
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


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('post-login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/beranda', [PageController::class, 'beranda'])->name('beranda');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::get('/edit-profile', 'AuthController@editProfile')->name('edit-profile');
Route::put('/update-profile', 'AuthController@updateProfile')->name('update-profile');
Route::get('/edit-password', 'AuthController@editPassword')->name('edit-password');
Route::patch('/update-password', 'AuthController@updatePassword')->name('update-password');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::get('/users/{user}/reset-password', 'UserController@resetPassword')->name('users.reset-password');
Route::put('/users/{user}/update-password', 'UserController@updatePassword')->name('users.update-password');
Route::resource('users', UserController::class)->only('index', 'create', 'destroy', 'store', 'update', 'edit');


Route::resource('transaksi', TransaksiController::class)->only(['index', 'store', 'update', 'destroy']);
Route::get('/transaksi/pemasukan', [TransaksiController::class, 'indexPemasukan'])->name('transaksi.pemasukan.index');
Route::get('/transaksi/pemasukan/create', [TransaksiController::class, 'createPemasukan'])->name('transaksi.pemasukan.create');
Route::get('/transaksi/pengeluaran', [TransaksiController::class, 'indexPengeluaran'])->name('transaksi.pengeluaran.index');
Route::get('/transaksi/pengeluaran/create', [TransaksiController::class, 'createPengeluaran'])->name('transaksi.pengeluaran.create');
Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
Route::post('/transaksi/laporan/download', [TransaksiController::class, 'laporanPDF'])->name('transaksi.download');


Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.index');
Route::get('/instansi/{id}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
Route::put('/instansi/{id}', [InstansiController::class, 'update'])->name('instansi.update');
