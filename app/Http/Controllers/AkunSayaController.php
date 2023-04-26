<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClassRoom;
use App\Models\Competency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AkunSayaController extends Controller
{
    public function akunsaya()
    {
        $user = Auth::user();
        $classrooms = ClassRoom::all();
        $competencies = Competency::all();

        return view('pages.akun-saya', [
            'user' => $user,
            'classrooms' => $classrooms,
            'competencies' => $competencies
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $item = Auth::user();

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $item->update($data);

        return redirect('/akun-saya');
    }
}
