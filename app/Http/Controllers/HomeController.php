<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $koleksi = Book::all()->count();
        $eksemplar = Book::all()->sum('jumlah');
        $anggota = User::where('role', 'Anggota')->where('status', 'Terverifikasi')->count();
        $peminjaman = Loan::where('status', 'Belum dikembalikan')->count();
        $pengembalian = Loan::where('status', 'Sudah dikembalikan')->count();
        return view('pages/home', compact('koleksi', 'eksemplar', 'anggota', 'peminjaman', 'pengembalian'));
    }
}
