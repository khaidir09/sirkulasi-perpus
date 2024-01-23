<?php

namespace App\Http\Livewire;

use App\Models\Librarian;
use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPustakawan extends Component
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
        $count = Librarian::all()->count();
        return view('livewire.admin-pustakawan', [
            'count' => $count,
            'librarians' => $this->search === null ?
                Librarian::latest()->paginate($this->paginate) :
                Librarian::latest()->where('name', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
