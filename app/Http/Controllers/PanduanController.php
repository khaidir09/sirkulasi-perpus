<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class PanduanController extends Controller
{
    public function index()
    {
        return view('pages/panduan');
    }
}
