<?php

namespace App\Http\Controllers\Pustakawan;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\Bookings;
use App\Mail\bookingExpired;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\LoanRequest;

class BookingBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Bookings::with('user')->simplePaginate(10);
        $bookings_count = Bookings::all()->count();
        return view('pages.booking.index', compact('bookings', 'bookings_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request)
    {

        //
    }

    public function confirmBooking($id, Request $request)
    {
        // Ambil data booking berdasarkan ID
        $booking = Bookings::find($id);

        $books = Book::find($request->books_id);

        $file = $request->input('foto_bukti');
        $anggota = $request->input('users_id');
        $buku = $request->input('books_id');
        $status = $request->input('status');
        $kuantitas = $request->input('kuantitas');

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

        // Ambil index_number buku yang dipilih
        $indexNumber = $books->nomor_induk;

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

        $peminjaman['foto_bukti'] = $fileName;
        $peminjaman['users_id'] = $anggota;
        $peminjaman['books_id'] = $buku;
        $peminjaman['kode_buku'] = $kodeBuku;
        $peminjaman['status'] = $status;
        $peminjaman['kuantitas'] = $kuantitas;

        Loan::create($peminjaman, $anggota, $buku, $status, $kuantitas, $kodeBuku);

        $books->ketersediaan -= $request->kuantitas;
        $books->save();

        // Hapus data booking dari tabel Bookings
        $booking->delete();

        // Redirect atau kembalikan response sesuai kebutuhan
        return redirect()->route('booking.index');
    }

    public function kirimEmail($userId)
    {
        $user = User::findOrFail($userId);
        $booking = Bookings::where('users_id', $userId)->first();
        $userName = $user->name;
        $bookTitle = $booking->judul_buku;
        Mail::to($user->email)->send(new bookingExpired($userName, $bookTitle));
        return redirect()->route('booking.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Bookings::findOrFail($id);

        return view('pages.booking.konfirmasi', [
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
        //
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

        $item = Bookings::findOrFail($id);

        $item->update($data);

        return redirect()->route('booking.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Bookings::findOrFail($id);

        $item->delete();

        return redirect()->route('booking.index');
    }
}
