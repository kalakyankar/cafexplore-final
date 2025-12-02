<?php

namespace App\Livewire\Admin\Collections;

use Livewire\Component;
use App\Models\Collection;
use App\Models\Cafe;

class CollectionCreate extends Component
{
    public $title = '';
    public $description = '';
    public $selectedCafes = [];
    public $isPublished = false;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'selectedCafes' => 'required|array|min:1',
    ];

    public function toggleCafe($cafeId)
    {
        if (in_array($cafeId, $this->selectedCafes)) {
            $this->selectedCafes = array_diff($this->selectedCafes, [$cafeId]);
        } else {
            $this->selectedCafes[] = $cafeId;
        }
    }

    public function submit()
    {
        $this->validate();

        $collection = Collection::create([
            'admin_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'is_published' => $this->isPublished,
        ]);

        // Attach cafes with sort order
        foreach ($this->selectedCafes as $index => $cafeId) {
            $collection->cafes()->attach($cafeId, ['sort_order' => $index]);
        }

        session()->flash('success', 'Koleksi berhasil dibuat');
        
        return redirect()->route('admin.collections.index');
    }

    public function render()
    {
        $cafes = Cafe::approved()
            ->with('primaryPhoto')
            ->latest()
            ->get();

        return view('livewire.admin.collections.collection-create', [
            'cafes' => $cafes,
        ])->layout('components.admin-layout', ['title' => 'Buat Koleksi Baru']);
    }
}