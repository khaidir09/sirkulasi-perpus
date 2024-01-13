<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AkunSayaController;
use App\Http\Controllers\CariBukuController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanBukuController;
use App\Http\Controllers\Pustakawan\BukuController as PustakawanBukuController;
use App\Http\Controllers\Pustakawan\TamuController as PustakawanTamuController;
use App\Http\Controllers\Pustakawan\AnggotaController as PustakawanAnggotaController;
use App\Http\Controllers\Pustakawan\PendaftaranAnggotaController as PustakawanPendaftaranAnggotaController;
use App\Http\Controllers\Pustakawan\DashboardController as PustakawanDashboardController;
use App\Http\Controllers\Pustakawan\PeminjamanController as PustakawanPeminjamanController;
use App\Http\Controllers\Pustakawan\BookingBukuController as PustakawanBookingBukuController;
use App\Http\Controllers\Pustakawan\PenerbitBukuController as PustakawanPenerbitBukuController;
use App\Http\Controllers\Pustakawan\PengajuanBukuController as PustakawanPengajuanBukuController;
use App\Http\Controllers\Pustakawan\KlasifikasiBukuController as PustakawanKlasifikasiBukuController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\RiwayatBookingController;
use App\Http\Controllers\Administrator\DashboardController as AdministratorDashboardController;

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
Route::get('panduan', [PanduanController::class, 'index'])->name('panduan');
Route::get('/pustakawan/dashboard', [PustakawanDashboardController::class, 'index'])->name('pustakawan-dashboard');
Route::resource('anggota/list-anggota', PustakawanAnggotaController::class);
Route::resource('anggota/pendaftaran', PustakawanPendaftaranAnggotaController::class);
Route::resource('buku/klasifikasi', PustakawanKlasifikasiBukuController::class);
Route::resource('buku/penerbit', PustakawanPenerbitBukuController::class);
Route::resource('buku/buku', PustakawanBukuController::class);
Route::resource('peminjaman/peminjaman', PustakawanPeminjamanController::class);
Route::resource('peminjaman/booking', PustakawanBookingBukuController::class);
Route::post('peminjaman/confirm-booking/{id}', [PustakawanBookingBukuController::class, 'confirmBooking'])->name('konfirmasi-booking');
Route::get('peminjaman/status/{id}', [PustakawanPeminjamanController::class, 'status'])->name('ubah-status-peminjaman');
Route::resource('tamu', PustakawanTamuController::class);
Route::resource('daftar-pengajuan', PustakawanPengajuanBukuController::class);

Route::get('laporan', [PustakawanBukuController::class, 'cetak'])->name('cetak-jumlah-buku');
Route::get('laporan-penambahan', [PustakawanBukuController::class, 'cetakpenambahan'])->name('cetak-penambahan-jumlah-buku');
Route::get('laporan-dipinjam', [PustakawanBukuController::class, 'cetakdipinjam'])->name('cetak-jumlah-buku-dipinjam');
Route::get('laporan-dikembalikan', [PustakawanBukuController::class, 'cetakdikembalikan'])->name('cetak-jumlah-buku-dikembalikan');

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

Route::middleware('ensureAdministratorRole:Administrator', 'verified')->group(function () {

    Route::get('/administrator/dashboard', [AdministratorDashboardController::class, 'index'])->name('administrator-dashboard');
});
