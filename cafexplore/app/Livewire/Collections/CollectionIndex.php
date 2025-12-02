<?php

namespace App\Livewire\Collections;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Collection;

class CollectionIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $collections = Collection::published()
            ->withCount('cafes')
            ->with('admin')
            ->latest()
            ->paginate(12);

        return view('livewire.collections.collection-index', [
            'collections' => $collections,
        ])->layout('components.layout', ['title' => 'Koleksi']);
    }
}