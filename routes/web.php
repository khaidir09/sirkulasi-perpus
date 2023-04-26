<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\CariBukuController;
use App\Http\Controllers\AkunSayaController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KlasifikasiController;

use App\Http\Controllers\TransactionController;
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

Route::redirect('/', 'login');
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

    // Route::get('/cari-buku', [CariBukuController::class, 'index'])->name('cari-buku');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route for the getting the data feed
    // Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');
    // Route::get('/data-anggota', [AnggotaController::class, 'index'])->name('data-anggota');
    // Route::get('/buku/klasifikasi', [KlasifikasiController::class, 'index'])->name('klasifikasi-buku');
    // Route::get('/buku/penerbit', [PenerbitController::class, 'index'])->name('penerbit-buku');
    // Route::get('/buku/list', [BukuController::class, 'index'])->name('buku');
    // Route::get('/transaksi-peminjaman', [PeminjamanController::class, 'index'])->name('transaksi-peminjaman');
    // Route::get('/tamu', [TamuController::class, 'index'])->name('tamu');
    // Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    // Route::get('/ecommerce/customers', [CustomerController::class, 'index'])->name('customers');
    // Route::get('/ecommerce/orders', [OrderController::class, 'index'])->name('orders');
    // Route::get('/ecommerce/invoices', [InvoiceController::class, 'index'])->name('invoices');

    // Route::get('/settings/account', function () {
    //     return view('pages/settings/account');
    // })->name('account');
    // Route::get('/settings/notifications', function () {
    //     return view('pages/settings/notifications');
    // })->name('notifications');

});

// Auth::routes(['verify' => true]);
