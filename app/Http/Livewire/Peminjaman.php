<?php

namespace App\Http\Livewire;

use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;

class Peminjaman extends Component
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
        $loan_count = Loan::all()->count();
        return view('livewire.peminjaman', [
            'loan_count' => $loan_count,
            'loans' => $this->search === null ?
                Loan::with('book')->latest()->paginate($this->paginate) :
                Loan::with('book')->latest()->where('book->judul', 'like', '%' . $this->search . '%')->get()
        ]);
    }
}
