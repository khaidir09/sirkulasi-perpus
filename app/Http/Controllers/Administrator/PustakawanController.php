<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Librarian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PustakawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.pustakawan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pustakawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/pustakawan', 'public');

        Librarian::create($data);

        return redirect()->route('admin-pustakawan.index');
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
        $item = Librarian::findOrFail($id);

        return view('pages.admin.pustakawan.edit', [
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
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Librarian::findOrFail($id);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('assets/pustakawan', 'public');
        }

        $item->update($data);

        return redirect()->route('admin-pustakawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Librarian::findOrFail($id);

        $item->delete();

        Alert::success('Berhasil', 'Data pustakawan berhasil dihapus');

        return redirect()->route('admin-pustakawan.index');
    }
}
