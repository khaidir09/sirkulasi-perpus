<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\DataFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{

    /**
     * Displays the dashboard screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $loans = Loan::where('users_id', Auth::user()->id)->with('book')->simplePaginate(10);
        $loans_count = Loan::all()->count();
        return view('pages/dashboard', compact('loans', 'loans_count'));
    }
}
