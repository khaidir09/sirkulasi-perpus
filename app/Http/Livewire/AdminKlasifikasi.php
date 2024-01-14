<?php

namespace App\Http\Livewire;

use App\Models\Classification;
use Livewire\Component;
use Livewire\WithPagination;

class AdminKlasifikasi extends Component
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
        $classification_count = Classification::all()->count();
        return view('livewire.admin-klasifikasi', [
            'classification_count' => $classification_count,
            'classifications' => $this->search === null ?
                Classification::latest()->paginate($this->paginate) :
                Classification::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
