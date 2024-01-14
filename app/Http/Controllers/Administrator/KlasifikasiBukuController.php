<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Classification;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\ClassificationRequest;

class KlasifikasiBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classifications = Classification::paginate(10);
        $classifications_count = Classification::all()->count();
        return view('pages.admin.buku.klasifikasi.index', compact('classifications', 'classifications_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.buku.klasifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassificationRequest $request)
    {
        $data = $request->all();

        Classification::create($data);

        return redirect()->route('admin-klasifikasi.index');
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
        $item = Classification::findOrFail($id);

        return view('pages.admin.buku.klasifikasi.edit', [
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
    public function update(ClassificationRequest $request, $id)
    {
        $data = $request->all();

        $item = Classification::findOrFail($id);

        $item->update($data);

        Alert::success('Berhasil', 'Data klasifikasi buku berhasil diperbarui');

        return redirect()->route('admin-klasifikasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Classification::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-klasifikasi.index');
    }
}
