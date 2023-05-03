<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AkunSayaController;
use App\Http\Controllers\CariBukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanBukuController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\TamuController as AdminTamuController;
use App\Http\Controllers\Admin\AnggotaController as AdminAnggotaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\PenerbitBukuController as AdminPenerbitBukuController;
use App\Http\Controllers\Admin\PengajuanBukuController as AdminPengajuanBukuController;
use App\Http\Controllers\Admin\KlasifikasiBukuController as AdminKlasifikasiBukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
Route::resource('anggota', AdminAnggotaController::class);
Route::resource('klasifikasi', AdminKlasifikasiBukuController::class);
Route::resource('penerbit', AdminPenerbitBukuController::class);
Route::resource('buku', AdminBukuController::class);
Route::resource('peminjaman', AdminPeminjamanController::class);
Route::get('peminjaman/status/{id}', [AdminPeminjamanController::class, 'status'])->name('ubah-status-peminjaman');
Route::resource('tamu', AdminTamuController::class);
Route::resource('daftar-pengajuan', AdminPengajuanBukuController::class);

Route::get('laporan', [AdminBukuController::class, 'cetak'])->name('cetak-jumlah-buku');
Route::get('laporanpenambahan', [AdminBukuController::class, 'cetakpenambahan'])->name('cetak-penambahan-jumlah-buku');

Route::middleware('ensureAnggotaRole:Anggota', 'verified')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cari-buku', [CariBukuController::class, 'index'])->name('cari-buku');
    Route::get('/akun-saya', [AkunSayaController::class, 'akunsaya'])->name('akun-saya');
    Route::post('/akun-saya/{redirect}', [AkunSayaController::class, 'update'])->name('akun-saya-update');
    Route::resource('pengajuan', PengajuanBukuController::class);
});
