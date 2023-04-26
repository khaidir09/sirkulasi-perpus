<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'Guru')->simplePaginate(10);
        $users_count = User::all()->count();
        return view('pages/anggota/index', compact('users', 'users_count'));
    }
}
