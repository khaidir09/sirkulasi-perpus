<?php

namespace App\Http\Controllers\Pustakawan;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\Wishlist;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Displays the dashboard screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $dipinjam = Loan::where('status', 'Belum Dikembalikan')->count();
        $stokbuku = Book::all()->sum('jumlah');
        $wishlist = Wishlist::count();
        $anggota = User::where('role', 'Anggota')->where('status', 'Terverifikasi')->count();
        $koleksibuku = Book::count();

        return view('pages/dashboard/dashboard', compact('stokbuku', 'dipinjam', 'wishlist', 'koleksibuku', 'anggota'));
    }
}
