<?php

namespace App\Livewire\Cafes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cafe;
use App\Models\Facility;
use App\Models\Vibe;

class CafeIndex extends Component
{
    use WithPagination;

    // Filter properties
    public $search = '';
    public $priceRange = '';
    public $selectedFacilities = [];
    public $selectedVibes = [];
    public $isOpen = '';
    public $sortBy = 'latest'; // latest, rating, name

    // UI State
    public $showFilters = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'priceRange' => ['except' => ''],
        'selectedFacilities' => ['except' => []],
        'selectedVibes' => ['except' => []],
        'isOpen' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPriceRange()
    {
        $this->resetPage();
    }

    public function updatingIsOpen()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function toggleFacility($facilityId)
    {
        if (in_array($facilityId, $this->selectedFacilities)) {
            $this->selectedFacilities = array_diff($this->selectedFacilities, [$facilityId]);
        } else {
            $this->selectedFacilities[] = $facilityId;
        }
        $this->resetPage();
    }

    public function toggleVibe($vibeId)
    {
        if (in_array($vibeId, $this->selectedVibes)) {
            $this->selectedVibes = array_diff($this->selectedVibes, [$vibeId]);
        } else {
            $this->selectedVibes[] = $vibeId;
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'priceRange', 'selectedFacilities', 'selectedVibes', 'isOpen', 'sortBy']);
        $this->resetPage();
    }

    public function toggleBookmark($cafeId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        if ($user->hasBookmarked($cafeId)) {
            $user->bookmarks()->detach($cafeId);
            session()->flash('success', 'Kafe dihapus dari bookmark');
        } else {
            $user->bookmarks()->attach($cafeId);
            session()->flash('success', 'Kafe ditambahkan ke bookmark');
        }
    }

    public function render()
    {
        $query = Cafe::approved()
            ->with(['primaryPhoto', 'facilities', 'vibes'])
            ->withCount('reviews');

        // Search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('address', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Filter by price range
        if ($this->priceRange) {
            $query->where('price_range', $this->priceRange);
        }

        // Filter by open/closed
        if ($this->isOpen !== '') {
            $query->where('is_closed', !$this->isOpen);
        }

        // Filter by facilities
        if (!empty($this->selectedFacilities)) {
            $query->whereHas('facilities', function($q) {
                $q->whereIn('facility_id', $this->selectedFacilities);
            }, '=', count($this->selectedFacilities));
        }

        // Filter by vibes
        if (!empty($this->selectedVibes)) {
            $query->whereHas('vibes', function($q) {
                $q->whereIn('vibe_id', $this->selectedVibes);
            });
        }

        // Sorting
        switch ($this->sortBy) {
            case 'rating':
                $query->withAvg('reviews as average_rating', 'rating')
                      ->orderByDesc('average_rating');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $cafes = $query->paginate(12);
        $facilities = Facility::all();
        $vibes = Vibe::all();

        return view('livewire.cafes.cafe-index', [
            'cafes' => $cafes,
            'facilities' => $facilities,
            'vibes' => $vibes,
        ])->layout('components.layout', ['title' => 'Jelajah Kafe']);
    }
}