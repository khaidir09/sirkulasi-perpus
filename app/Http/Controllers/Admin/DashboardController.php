<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\DataFeed;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

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
        $anggota = User::where('role', 'Anggota')->count();
        $koleksibuku = Book::count();

        return view('pages/dashboard/dashboard', compact('stokbuku', 'dipinjam', 'wishlist', 'koleksibuku', 'anggota'));
    }
}
