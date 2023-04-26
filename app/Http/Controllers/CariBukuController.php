<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CariBukuController extends Controller
{
    public function index()
    {
        $books = Book::with('loan')->paginate(10);
        $books_count = Book::all()->count();
        return view('pages/cari-buku', compact('books', 'books_count'));
    }
}
