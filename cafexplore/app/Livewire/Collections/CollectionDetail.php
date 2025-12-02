<?php

namespace App\Livewire\Collections;

use Livewire\Component;
use App\Models\Collection;

class CollectionDetail extends Component
{
    public Collection $collection;

    public function mount($collection)
    {
        $this->collection = Collection::published()
            ->with(['cafes' => function($query) {
                $query->approved()
                      ->with(['primaryPhoto', 'facilities', 'vibes'])
                      ->withCount('reviews');
            }, 'admin'])
            ->where('slug', $collection)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.collections.collection-detail')
            ->layout('components.layout', ['title' => $this->collection->title]);
    }
}