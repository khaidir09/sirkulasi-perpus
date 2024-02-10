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

    public function confirmBooking($id, LoanRequest $request)
    {
        // Ambil data booking berdasarkan ID
        $booking = Bookings::find($id);

        // Buat entry baru di tabel Loans dengan data dari booking
        $imageName = time() . '.' . $request->foto_bukti->extension();
        $uploadedImage = $request->foto_bukti->store('assets/peminjaman', 'public', $imageName);

        Loan::create([
            'users_id' => $request->users_id,
            'books_id' => $request->books_id,
            'status' => $request->status,
            'kuantitas' => $request->kuantitas,
            'foto_bukti' => $uploadedImage
        ]);

        $books = Book::find($request->books_id);
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
