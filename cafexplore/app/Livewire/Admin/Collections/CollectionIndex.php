<?php

namespace App\Livewire\Admin\Collections;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Collection;

class CollectionIndex extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function togglePublish($collectionId)
    {
        $collection = Collection::findOrFail($collectionId);
        $collection->update(['is_published' => !$collection->is_published]);
        
        session()->flash('success', 'Status koleksi berhasil diupdate');
    }

    public function deleteCollection($collectionId)
    {
        $collection = Collection::findOrFail($collectionId);
        $collection->delete();
        
        session()->flash('success', 'Koleksi berhasil dihapus');
    }

    public function render()
    {
        $query = Collection::with('admin')->withCount('cafes');

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        $collections = $query->latest()->paginate(15);

        return view('livewire.admin.collections.collection-index', [
            'collections' => $collections,
        ])->layout('components.admin-layout', ['title' => 'Kelola Koleksi']);
    }
}