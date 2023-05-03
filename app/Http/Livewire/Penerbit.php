<?php

namespace App\Http\Livewire;

use App\Models\Publisher;
use Livewire\Component;
use Livewire\WithPagination;

class Penerbit extends Component
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
        $publisher_count = Publisher::all()->count();
        return view('livewire.penerbit', [
            'publisher_count' => $publisher_count,
            'publishers' => $this->search === null ?
                Publisher::latest()->paginate($this->paginate) :
                Publisher::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
