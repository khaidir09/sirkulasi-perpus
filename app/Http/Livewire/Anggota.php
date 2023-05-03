<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Anggota extends Component
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
        $members_count = User::where('role', 'Anggota')->count();
        return view('livewire.anggota', [
            'members_count' => $members_count,
            'members' => $this->search === null ?
                User::latest()->where('role', 'Anggota')->paginate($this->paginate) :
                User::latest()->where('role', 'Anggota')->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
