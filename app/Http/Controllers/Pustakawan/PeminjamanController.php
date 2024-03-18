<?php

namespace App\Http\Controllers\Pustakawan;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoanRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::with('user', 'book')->simplePaginate(10);
        $loans_count = Loan::all()->count();
        return view('pages.peminjaman.index', compact('loans', 'loans_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'Anggota')->get();
        $books = Book::all();
        return view('pages.peminjaman.create', compact('users', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request)
    {
        $data = $request->all();

        // Simpan gambar dari kamera
        $imageData = $request->input('image'); // Diambil dari data URL yang dikirim melalui AJAX
        $filteredData = substr($imageData, strpos($imageData, ",") + 1);
        $decodedData = base64_decode($filteredData);
        $fileName = 'gambar_' . uniqid() . '.png';
        $filePath = 'public/storage/assets/peminjaman' . $fileName; // Sesuaikan dengan direktori penyimpanan Anda
        file_put_contents($filePath, $decodedData);
        $data['foto_bukti'] = $fileName;

        Loan::create($data);

        $books = Book::find($request->books_id);
        $books->ketersediaan -= $request->kuantitas;
        $books->save();

        return redirect()->route('peminjaman.index');
    }

    public function status($id)
    {
        $item = Loan::findOrFail($id);
        return view('pages.peminjaman.status', [
            'item' => $item
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Loan::findOrFail($id);
        return view('pages.peminjaman.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Loan::findOrFail($id);
        $users = User::all();
        $books = Book::all();

        return view('pages.peminjaman.edit', [
            'item' => $item,
            'users' => $users,
            'books' => $books
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Loan::findOrFail($id);

        if ($request->hasFile('foto_bukti')) {
            $data['foto_bukti'] = $request->file('foto_bukti')->store('assets/peminjaman', 'public');
        }

        $item->update($data);

        if ($request->status === "Sudah dikembalikan") {
            $books = Book::find($request->books_id);
            $books->ketersediaan += $request->kuantitas;
            $books->save();
        }

        return redirect()->route('peminjaman.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Loan::findOrFail($id);

        $item->delete();

        Alert::success('Berhasil', 'Data tranasksi peminjaman berhasil dihapus');

        return redirect()->route('peminjaman.index');
    }
}
