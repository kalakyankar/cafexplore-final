<?php

namespace App\Livewire\Admin\Vibes;

use Livewire\Component;
use App\Models\Vibe;

class VibeIndex extends Component
{
    public $name = '';
    public $editMode = false;
    public $editId = null;

    protected $rules = [
        'name' => 'required|min:2|max:50',
    ];

    public function save()
    {
        $this->validate();

        if ($this->editMode) {
            $vibe = Vibe::findOrFail($this->editId);
            $vibe->update(['name' => $this->name]);
            session()->flash('success', 'Vibe berhasil diupdate');
        } else {
            Vibe::create(['name' => $this->name]);
            session()->flash('success', 'Vibe berhasil ditambahkan');
        }

        $this->reset(['name', 'editMode', 'editId']);
    }

    public function edit($id)
    {
        $vibe = Vibe::findOrFail($id);
        $this->editId = $id;
        $this->name = $vibe->name;
        $this->editMode = true;
    }

    public function cancelEdit()
    {
        $this->reset(['name', 'editMode', 'editId']);
    }

    public function delete($id)
    {
        $vibe = Vibe::findOrFail($id);
        $vibe->delete();
        session()->flash('success', 'Vibe berhasil dihapus');
    }

    public function render()
    {
        $vibes = Vibe::withCount('cafes')->latest()->get();

        return view('livewire.admin.vibes.vibe-index', [
            'vibes' => $vibes,
        ])->layout('components.admin-layout', ['title' => 'Kelola Vibes']);
    }
}