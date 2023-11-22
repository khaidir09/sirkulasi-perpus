<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use App\Models\Bookings;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class AnggotaRiwayatBooking extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $bookings_count = Bookings::where('users_id', Auth::user()->id)->count();
        return view('livewire.anggota-riwayat-booking', [
            'bookings_count' => $bookings_count,
            'bookings' => $this->search === null ?
                Bookings::latest()->where('users_id', Auth::user()->id)->paginate($this->paginate) :
                Bookings::latest()->where('users_id', Auth::user()->id)->where('judul', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
