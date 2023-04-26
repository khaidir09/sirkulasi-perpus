<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Models\Classification;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookRequest;
use App\Models\Loan;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('loan')->paginate(10);
        $books_count = Book::all()->count();

        return view('pages.buku.buku.index', compact('books', 'books_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        $classifications = Classification::all();
        return view('pages.buku.buku.create', [
            'publishers' => $publishers,
            'classifications' => $classifications
        ]);
    }

    public function cetak()
    {
        $books = Book::all();

        $pdf = PDF::loadView('pages.buku.buku.cetak', ['books' => $books])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function cetakpenambahan()
    {
        $jumlahkaryaumum = Book::with('classification')->where('classifications_id', 1)->count();
        $jumlahbukukaryaumum = Book::with('classification')->where('classifications_id', 1)->sum('jumlah');
        $jumlahfilsafat = Book::with('classification')->where('classifications_id', 2)->count();
        $jumlahbukufilsafat = Book::with('classification')->where('classifications_id', 2)->sum('jumlah');
        $jumlahagama = Book::with('classification')->where('classifications_id', 3)->count();
        $jumlahbukuagama = Book::with('classification')->where('classifications_id', 3)->sum('jumlah');
        $jumlahilmusosial = Book::with('classification')->where('classifications_id', 4)->count();
        $jumlahbukuilmusosial = Book::with('classification')->where('classifications_id', 4)->sum('jumlah');
        $jumlahbahasa = Book::with('classification')->where('classifications_id', 5)->count();
        $jumlahbukubahasa = Book::with('classification')->where('classifications_id', 5)->sum('jumlah');

        $pdf = PDF::loadView('pages.buku.buku.cetak-penambahan', [
            'jumlahkaryaumum' => $jumlahkaryaumum,
            'jumlahbukukaryaumum' => $jumlahbukukaryaumum,
            'jumlahfilsafat' => $jumlahfilsafat,
            'jumlahbukufilsafat' => $jumlahbukufilsafat,
            'jumlahagama' => $jumlahagama,
            'jumlahbukuagama' => $jumlahbukuagama,
            'jumlahilmusosial' => $jumlahilmusosial,
            'jumlahbukuilmusosial' => $jumlahbukuilmusosial,
            'jumlahbahasa' => $jumlahbahasa,
            'jumlahbukubahasa' => $jumlahbukubahasa,
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();

        Book::create($data);

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Book::findOrFail($id);
        $publishers = Publisher::all();
        $classifications = Classification::all();

        return view('pages.buku.buku.edit', [
            'item' => $item,
            'publishers' => $publishers,
            'classifications' => $classifications
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        $data = $request->all();

        $item = Book::findOrFail($id);

        $item->update($data);

        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Book::findOrFail($id);

        $item->delete();

        return redirect()->route('buku.index');
    }
}
