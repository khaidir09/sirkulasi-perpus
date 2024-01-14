<?php

namespace App\Http\Livewire;

use App\Models\Guest;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTamu extends Component
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
        $guest_count = Guest::all()->count();
        return view('livewire.admin-tamu', [
            'guest_count' => $guest_count,
            'guests' => $this->search === null ?
                Guest::with('user')->latest()->paginate($this->paginate) :
                Guest::with('user')->latest()->where('user->name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
