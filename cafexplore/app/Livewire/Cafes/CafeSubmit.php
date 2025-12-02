<?php

namespace App\Livewire\Cafes;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Cafe;
use App\Models\CafePhoto;
use App\Models\Facility;
use App\Models\Vibe;
use Illuminate\Support\Facades\Storage;

class CafeSubmit extends Component
{
    use WithFileUploads;

    // Cafe Info
    public $name = '';
    public $address = '';
    public $description = '';
    public $phone = '';
    public $website = '';
    public $latitude = '';
    public $longitude = '';
    public $priceRange = 'moderate';
    
    // Operating Hours
    public $monday = '';
    public $tuesday = '';
    public $wednesday = '';
    public $thursday = '';
    public $friday = '';
    public $saturday = '';
    public $sunday = '';
    
    // Relations
    public $selectedFacilities = [];
    public $selectedVibes = [];
    
    // Photos
    public $photos = [];

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'address' => 'required|min:10',
        'description' => 'nullable|max:1000',
        'phone' => 'nullable|max:20',
        'website' => 'nullable|url',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'priceRange' => 'required|in:cheap,moderate,expensive',
        'photos.*' => 'nullable|image|max:2048',
        'selectedFacilities' => 'nullable|array',
        'selectedVibes' => 'nullable|array',
    ];

    public function toggleFacility($facilityId)
    {
        if (in_array($facilityId, $this->selectedFacilities)) {
            $this->selectedFacilities = array_diff($this->selectedFacilities, [$facilityId]);
        } else {
            $this->selectedFacilities[] = $facilityId;
        }
    }

    public function toggleVibe($vibeId)
    {
        if (in_array($vibeId, $this->selectedVibes)) {
            $this->selectedVibes = array_diff($this->selectedVibes, [$vibeId]);
        } else {
            $this->selectedVibes[] = $vibeId;
        }
    }

    public function removePhoto($index)
    {
        unset($this->photos[$index]);
        $this->photos = array_values($this->photos); // Re-index array
    } // ← PASTIKAN ADA KURUNG TUTUP INI!

    public function submit()
    {
        $this->validate();

        // Create cafe
        $cafe = Cafe::create([
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->description,
            'phone' => $this->phone,
            'website' => $this->website,
            'latitude' => $this->latitude ?: null,
            'longitude' => $this->longitude ?: null,
            'price_range' => $this->priceRange,
            'cafe_operating_hours' => [
                'monday' => $this->monday,
                'tuesday' => $this->tuesday,
                'wednesday' => $this->wednesday,
                'thursday' => $this->thursday,
                'friday' => $this->friday,
                'saturday' => $this->saturday,
                'sunday' => $this->sunday,
            ],
            'is_closed' => false,
            'status' => 'pending',
        ]);

        // Attach facilities
        if (!empty($this->selectedFacilities)) {
            $cafe->facilities()->attach($this->selectedFacilities);
        }

        // Attach vibes
        if (!empty($this->selectedVibes)) {
            $cafe->vibes()->attach($this->selectedVibes);
        }

        // Upload photos
        if (!empty($this->photos)) {
            foreach ($this->photos as $index => $photo) {
                $path = $photo->store('cafe-photos', 'public');
                
                CafePhoto::create([
                    'cafe_id' => $cafe->id,
                    'url' => Storage::url($path),
                    'is_primary' => $index === 0, // First photo is primary
                    'uploaded_by_user_id' => auth()->id(),
                ]);
            }
        }

        session()->flash('success', 'Terima kasih! Kafe Anda telah berhasil disubmit dan menunggu persetujuan admin.');
        
        return redirect()->route('cafes.index');
    }

    public function render()
    {
        $facilities = Facility::all();
        $vibes = Vibe::all();

        return view('livewire.cafes.cafe-submit', [
            'facilities' => $facilities,
            'vibes' => $vibes,
        ])->layout('components.layout', ['title' => 'Submit Kafe Baru']);
    }
}