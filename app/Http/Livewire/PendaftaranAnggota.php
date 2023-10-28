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
        $registers_count = User::where('role', 'Anggota')->where('status', null)->count();
        return view('livewire.pendaftaran-anggota', [
            'registers_count' => $registers_count,
            'members' => $this->search === null ?
                User::latest()->where('role', 'Anggota')->where('status', null)->paginate($this->paginate) :
                User::latest()->where('role', 'Anggota')->where('status', null)->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
