<?php

namespace App\Http\Livewire;

use App\Models\Bookings;
use Livewire\Component;
use Livewire\WithPagination;

class AdminBookingBuku extends Component
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
        $bookings_count = Bookings::all()->count();
        return view('livewire.admin-booking-buku', [
            'bookings_count' => $bookings_count,
            'bookings' => $this->search === null ?
                Bookings::latest()->paginate($this->paginate) :
                Bookings::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
