<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GuestRequest;
use App\Models\Book;
use App\Models\Guest;
use App\Models\User;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guests = Guest::with('user', 'book')->simplePaginate(10);
        $guests_count = Guest::all()->count();
        return view('pages.admin.tamu.index', compact('guests', 'guests_count'));
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
        return view('pages.admin.tamu.create', compact('users', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestRequest $request)
    {
        $data = $request->all();

        Guest::create($data);

        return redirect()->route('admin-tamu.index');
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
        $item = Guest::findOrFail($id);
        $users = User::all();
        $books = Book::all();

        return view('pages.admin.tamu.edit', [
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
    public function update(GuestRequest $request, $id)
    {
        $data = $request->all();

        $item = Guest::findOrFail($id);

        $item->update($data);

        return redirect()->route('admin-tamu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Guest::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-tamu.index');
    }
}
