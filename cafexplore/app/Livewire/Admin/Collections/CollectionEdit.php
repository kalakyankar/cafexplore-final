<?php

namespace App\Livewire\Admin\Collections;

use Livewire\Component;
use App\Models\Collection;
use App\Models\Cafe;

class CollectionEdit extends Component
{
    public Collection $collection;
    public $title;
    public $description;
    public $selectedCafes = [];
    public $isPublished;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'selectedCafes' => 'required|array|min:1',
    ];

    public function mount($collection)
    {
        $this->collection = Collection::with('cafes')->findOrFail($collection);
        $this->title = $this->collection->title;
        $this->description = $this->collection->description;
        $this->isPublished = $this->collection->is_published;
        $this->selectedCafes = $this->collection->cafes->pluck('id')->toArray();
    }

    public function toggleCafe($cafeId)
    {
        if (in_array($cafeId, $this->selectedCafes)) {
            $this->selectedCafes = array_diff($this->selectedCafes, [$cafeId]);
        } else {
            $this->selectedCafes[] = $cafeId;
        }
    }

    public function update()
    {
        $this->validate();

        $this->collection->update([
            'title' => $this->title,
            'description' => $this->description,
            'is_published' => $this->isPublished,
        ]);

        // Sync cafes with sort order
        $cafesWithSortOrder = [];
        foreach ($this->selectedCafes as $index => $cafeId) {
            $cafesWithSortOrder[$cafeId] = ['sort_order' => $index];
        }
        $this->collection->cafes()->sync($cafesWithSortOrder);

        session()->flash('success', 'Koleksi berhasil diupdate');
        
        return redirect()->route('admin.collections.index');
    }

    public function render()
    {
        $cafes = Cafe::approved()
            ->with('primaryPhoto')
            ->latest()
            ->get();

        return view('livewire.admin.collections.collection-edit', [
            'cafes' => $cafes,
        ])->layout('components.admin-layout', ['title' => 'Edit Koleksi']);
    }
}