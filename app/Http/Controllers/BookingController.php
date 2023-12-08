<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bookings;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $nama_anggota = User::find($request->users_id);
        $judul_buku = Book::find($request->books_id);

        if ($judul_buku->ketersediaan != 0) {
            $status = "Aktif";
        } else {
            $status = "Pending";
        }


        Bookings::create([
            'users_id' => $request->users_id,
            'nama_anggota' => $nama_anggota->name,
            'books_id' => $request->books_id,
            'judul_buku' => $judul_buku->judul,
            'expired' => Carbon::today()->addDays(3),
            'status' => $status
        ]);

        return redirect()->route('cari-buku');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
