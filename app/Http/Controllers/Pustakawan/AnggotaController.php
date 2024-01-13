<?php

namespace App\Http\Controllers\Pustakawan;

use App\Models\User;
use App\Models\ClassRoom;
use App\Models\Competency;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'Anggota')->simplePaginate(10);
        $users_count = User::where('role', 'Anggota')->count();
        return view('pages/anggota/index', compact('users', 'users_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::with('classroom')->get();
        $classrooms = ClassRoom::all();
        $competencies = Competency::all();

        return view('pages.anggota.create', [
            'users' => $users,
            'classrooms' => $classrooms,
            'competencies' => $competencies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        User::create($data);

        Alert::success('Berhasil', 'Data anggota berhasil ditambahkan');

        return redirect()->route('list-anggota.index');
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
        $item = User::findOrFail($id);
        $users = User::with(['classroom', 'competency'])->get();
        $classrooms = ClassRoom::all();
        $competencies = Competency::all();

        return view('pages.anggota.edit', [
            'item' => $item,
            'users' => $users,
            'classrooms' => $classrooms,
            'competencies' => $competencies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();

        $item = User::findOrFail($id);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $item->update($data);

        return redirect()->route('list-anggota.index');
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

        Alert::success('Berhasil', 'Data anggota berhasil dihapus');

        return redirect()->route('list-anggota.index');
    }
}
