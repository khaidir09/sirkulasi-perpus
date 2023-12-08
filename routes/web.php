<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AkunSayaController;
use App\Http\Controllers\CariBukuController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanBukuController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\TamuController as AdminTamuController;
use App\Http\Controllers\Admin\AnggotaController as AdminAnggotaController;
use App\Http\Controllers\Admin\PendaftaranAnggotaController as AdminPendaftaranAnggotaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\BookingBukuController as AdminBookingBukuController;
use App\Http\Controllers\Admin\PenerbitBukuController as AdminPenerbitBukuController;
use App\Http\Controllers\Admin\PengajuanBukuController as AdminPengajuanBukuController;
use App\Http\Controllers\Admin\KlasifikasiBukuController as AdminKlasifikasiBukuController;
use App\Http\Controllers\RiwayatBookingController;

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
Route::resource('anggota/list-anggota', AdminAnggotaController::class);
Route::resource('anggota/pendaftaran', AdminPendaftaranAnggotaController::class);
Route::resource('buku/klasifikasi', AdminKlasifikasiBukuController::class);
Route::resource('buku/penerbit', AdminPenerbitBukuController::class);
Route::resource('buku/buku', AdminBukuController::class);
Route::resource('peminjaman/peminjaman', AdminPeminjamanController::class);
Route::resource('peminjaman/booking', AdminBookingBukuController::class);
Route::post('peminjaman/confirm-booking/{id}', [AdminBookingBukuController::class, 'confirmBooking'])->name('konfirmasi-booking');
Route::get('peminjaman/status/{id}', [AdminPeminjamanController::class, 'status'])->name('ubah-status-peminjaman');
Route::resource('tamu', AdminTamuController::class);
Route::resource('daftar-pengajuan', AdminPengajuanBukuController::class);

Route::get('laporan', [AdminBukuController::class, 'cetak'])->name('cetak-jumlah-buku');
Route::get('laporan-penambahan', [AdminBukuController::class, 'cetakpenambahan'])->name('cetak-penambahan-jumlah-buku');
Route::get('laporan-dipinjam', [AdminBukuController::class, 'cetakdipinjam'])->name('cetak-jumlah-buku-dipinjam');
Route::get('laporan-dikembalikan', [AdminBukuController::class, 'cetakdikembalikan'])->name('cetak-jumlah-buku-dikembalikan');

Route::middleware('ensureAnggotaRole:Anggota', 'verified')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cari-buku', [CariBukuController::class, 'index'])->name('cari-buku');
    Route::get('/cari-buku/{id}', [CariBukuController::class, 'show'])->name('konfirmasi-booking-buku');
    Route::post('/cari-buku{id}', [BookingController::class, 'store'])->name('kirim-booking');
    Route::get('/akun-saya', [AkunSayaController::class, 'akunsaya'])->name('akun-saya');
    Route::post('/akun-saya/{redirect}', [AkunSayaController::class, 'update'])->name('akun-saya-update');
    Route::resource('pengajuan', PengajuanBukuController::class);
    Route::resource('riwayat-booking', RiwayatBookingController::class);
});
