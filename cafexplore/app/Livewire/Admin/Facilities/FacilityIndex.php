<?php

namespace App\Livewire\Admin\Facilities;

use Livewire\Component;
use App\Models\Facility;

class FacilityIndex extends Component
{
    public $name = '';
    public $icon = '';
    public $editMode = false;
    public $editId = null;

    protected $rules = [
        'name' => 'required|min:2|max:50',
        'icon' => 'required|max:50',
    ];

    public function save()
    {
        $this->validate();

        if ($this->editMode) {
            $facility = Facility::findOrFail($this->editId);
            $facility->update([
                'name' => $this->name,
                'icon' => $this->icon,
            ]);
            session()->flash('success', 'Fasilitas berhasil diupdate');
        } else {
            Facility::create([
                'name' => $this->name,
                'icon' => $this->icon,
            ]);
            session()->flash('success', 'Fasilitas berhasil ditambahkan');
        }

        $this->reset(['name', 'icon', 'editMode', 'editId']);
    }

    public function edit($id)
    {
        $facility = Facility::findOrFail($id);
        $this->editId = $id;
        $this->name = $facility->name;
        $this->icon = $facility->icon;
        $this->editMode = true;
    }

    public function cancelEdit()
    {
        $this->reset(['name', 'icon', 'editMode', 'editId']);
    }

    public function delete($id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();
        session()->flash('success', 'Fasilitas berhasil dihapus');
    }

    public function render()
    {
        $facilities = Facility::withCount('cafes')->latest()->get();

        return view('livewire.admin.facilities.facility-index', [
            'facilities' => $facilities,
        ])->layout('components.admin-layout', ['title' => 'Kelola Fasilitas']);
    }
}