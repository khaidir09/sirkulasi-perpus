<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAnggota extends Component
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
        $members_count = User::where('role', 'Anggota')->where('status', 'Terverifikasi')->count();
        return view('livewire.admin-anggota', [
            'members_count' => $members_count,
            'members' => $this->search === null ?
                User::latest()->where('role', 'Anggota')->where('status', 'Terverifikasi')->paginate($this->paginate) :
                User::latest()->where('role', 'Anggota')->where('status', 'Terverifikasi')->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }
}
