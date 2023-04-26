<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class PeminjamanController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(10);
        $invoices_count = Invoice::all()->count();
        return view('pages/peminjaman/index', compact('invoices', 'invoices_count'));
    }
}
