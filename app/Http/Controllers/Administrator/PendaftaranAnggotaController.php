<?php

namespace App\Http\Controllers\Administrator;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/admin/pendaftaran-anggota/index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::findOrFail($id);

        return view('pages.admin.pendaftaran-anggota.detail', [
            'item' => $item,
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

        $item = User::findOrFail($id);

        $item->update($data);

        // Transaction create
        // $item->update([
        //     'name' => $request->name,
        //     'nisn' => $request->nisn,
        //     'alamat' => $request->alamat,
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'tgl_lahir' => $request->tgl_lahir,
        //     'nomor_hp' => $request->nomor_hp,
        //     'nomor_hp_ortu' => $request->nomor_hp_ortu,
        //     'nama_ibu' => $request->nama_ibu,
        //     'competencies_id' => $request->competencies_id,
        //     'class_rooms_id' => $request->class_rooms_id,
        //     'email' => $request->email,
        //     'status' => $request->status
        // ]);

        return redirect()->route('admin-pendaftaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);

        $item->delete();

        Alert::success('Berhasil', 'Data pendaftaran anggota berhasil dihapus');

        return redirect()->route('admin-pendaftaran.index');
    }
}
