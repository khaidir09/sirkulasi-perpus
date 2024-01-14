<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\WishlistRequest;
use Illuminate\Support\Facades\Crypt;

class PengajuanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::where('users_id', Auth::user()->id)->simplePaginate(10);
        $wishlists_count = Wishlist::where('users_id', Auth::user()->id)->count();
        return view('pages.pengajuan-index', compact('wishlists', 'wishlists_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengajuan-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WishlistRequest $request)
    {
        Wishlist::create([
            'users_id' => $request['users_id'],
            'penerbit' => $request['penerbit'],
            'status' => $request['status'],
            'judul_buku' => $request['judul_buku'],
        ]);

        return redirect()->route('pengajuan.index');
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
        $item = Wishlist::findOrFail($id);

        return view('pages.pengajuan-edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WishlistRequest $request, $id)
    {
        $data = $request->all();

        $item = Wishlist::findOrFail($id);

        $item->update($data);

        return redirect()->route('pengajuan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Wishlist::findOrFail($id);

        $item->delete();

        return redirect()->route('pengajuan.index');
    }
}
