<?php

namespace App\Http\Controllers\Pustakawan;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
    public function store(Request $request)
    {
        $peminjaman = $request->all();

        $file = $request->input('foto_bukti');

        if (!$file) {
            return response([
                'message' => 'file not found',
                'succes' => false
            ], 400);
        }

        $data = null;

        if (preg_match('/^data:image\/(\w+);base64,/', $file, $type)) {
            $data = substr($file, strpos($file, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                return response([
                    'message' => 'invalid image type',
                    'succes' => false
                ], 400);
            }
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);

            if ($data === false) {
                return response([
                    'message' => 'invalid base64 string',
                    'succes' => false
                ], 400);
            }
        } else {
            return response([
                'message' => 'invalid uri string',
                'succes' => false
            ], 400);
        }

        $fileName = 'assets/peminjaman/' . uniqid() . ".{$type}";

        try {
            Storage::disk('local')->put('public/' . $fileName, $data);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
                'succes' => false
            ], 400);
        }

        $peminjaman['foto_bukti'] = $fileName;

        $buku = Book::find($request->books_id);

        // Ambil index_number buku yang dipilih
        $indexNumber = $buku->nomor_induk;

        // Ambil nilai awal dan akhir dari index_number
        list($start, $end) = explode('-', $indexNumber);

        // Cari nomor terakhir yang digunakan untuk index_number ini
        $lastLoan = Loan::whereBetween('kode_buku', ["$start", "$end"])->orderByDesc('kode_buku')->first();

        // Jika tidak ada peminjaman sebelumnya untuk index_number ini, gunakan nomor pertama
        if (!$lastLoan) {
            $nextNumber = $start;
        } else {
            // Ambil nomor terakhir dari index terakhir
            $lastNumber = intval($lastLoan->kode_buku);
            // Tingkatkan nomor dengan 1
            $nextNumber = $lastNumber + 1;
        }

        // Jika nomor sudah melebihi nilai akhir, kembalikan pesan kesalahan
        if ($nextNumber > intval($end)) {
            return response()->json(['message' => 'Semua buku dari kategori ini sudah terpinjam'], 400);
        }

        // Bentuk book_code baru
        $kodeBuku = $nextNumber;

        $peminjaman['kode_buku'] = $kodeBuku;

        Loan::create($peminjaman);

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
