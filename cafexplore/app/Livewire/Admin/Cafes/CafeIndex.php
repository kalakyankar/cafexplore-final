<?php

namespace App\Livewire\Admin\Cafes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cafe;

class CafeIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    protected $queryString = ['search', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function deleteCafe($cafeId)
    {
        $cafe = Cafe::findOrFail($cafeId);
        $cafe->delete();
        
        session()->flash('success', 'Kafe berhasil dihapus');
    }

    public function render()
    {
        $query = Cafe::with(['primaryPhoto', 'reviews']);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('address', 'like', '%' . $this->search . '%');
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $cafes = $query->latest()->paginate(15);

        return view('livewire.admin.cafes.cafe-index', [
            'cafes' => $cafes,
        ])->layout('components.admin-layout', ['title' => 'Kelola Kafe']);
    }
}