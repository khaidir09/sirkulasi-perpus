<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PendaftaranAnggota extends Component
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
        $registers_count = User::where('role', 'Anggota')->where('created_by', 'Website')->count();
        return view('livewire.pendaftaran-anggota', [
            'registers_count' => $registers_count,
            'members' => $this->search === null ?
                User::latest()->where('role', 'Anggota')->where('created_by', 'Website')->paginate($this->paginate) :
                User::latest()->where('role', 'Anggota')->where('created_by', 'Website')->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
