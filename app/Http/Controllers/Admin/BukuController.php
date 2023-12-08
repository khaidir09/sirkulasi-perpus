<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Models\Classification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookRequest;

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
        $jumlahkaryaumum = Book::with('classification')->where('classifications_id', 1)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count();
        $jumlahbukukaryaumum = Book::with('classification')->where('classifications_id', 1)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('jumlah');
        $jumlahfilsafat = Book::with('classification')->where('classifications_id', 2)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count();
        $jumlahbukufilsafat = Book::with('classification')->where('classifications_id', 2)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('jumlah');
        $jumlahagama = Book::with('classification')->where('classifications_id', 3)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count();
        $jumlahbukuagama = Book::with('classification')->where('classifications_id', 3)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('jumlah');
        $jumlahilmusosial = Book::with('classification')->where('classifications_id', 4)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count();
        $jumlahbukuilmusosial = Book::with('classification')->where('classifications_id', 4)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('jumlah');
        $jumlahbahasa = Book::with('classification')->where('classifications_id', 5)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count();
        $jumlahbukubahasa = Book::with('classification')->where('classifications_id', 5)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('jumlah');

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

    public function cetakdipinjam()
    {
        $classifications = Classification::all();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $summary = [];
        foreach ($classifications as $classification) {
            $totalPeminjaman = DB::table('loans')
                ->join('books', 'loans.books_id', '=', 'books.id')
                ->where('books.classifications_id', $classification->id)
                ->whereBetween('loans.created_at', [$startOfMonth, $endOfMonth])
                ->sum('loans.kuantitas');

            $summary[] = [
                'klasifikasi' => $classification->name,
                'total_peminjaman' => $totalPeminjaman,
            ];
        }

        $pdf = PDF::loadView('pages.buku.buku.cetak-dipinjam', ['classifications' => $classifications], ['summary' => $summary])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function cetakdikembalikan()
    {
        $classifications = Classification::all();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $summary = [];
        foreach ($classifications as $classification) {
            $totalPeminjaman = DB::table('loans')
                ->join('books', 'loans.books_id', '=', 'books.id')
                ->where('books.classifications_id', $classification->id)
                ->where('status', 'Sudah dikembalikan')
                ->whereBetween('loans.created_at', [$startOfMonth, $endOfMonth])
                ->sum('loans.kuantitas');

            $summary[] = [
                'klasifikasi' => $classification->name,
                'total_peminjaman' => $totalPeminjaman,
            ];
        }

        $pdf = PDF::loadView('pages.buku.buku.cetak-dikembalikan', ['classifications' => $classifications], ['summary' => $summary])->setPaper('a4', 'landscape');

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
