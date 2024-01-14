<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class AdminBuku extends Component
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
        $book_count = Book::all()->count();
        return view('livewire.admin-buku', [
            'book_count' => $book_count,
            'books' => $this->search === null ?
                Book::latest()->paginate($this->paginate) :
                Book::latest()->where('judul', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
