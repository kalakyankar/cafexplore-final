<?php

namespace App\Livewire\Admin\Cafes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cafe;

class CafePending extends Component
{
    use WithPagination;

    public function approveCafe($cafeId)
    {
        $cafe = Cafe::findOrFail($cafeId);
        $cafe->update(['status' => 'approved']);
        
        session()->flash('success', 'Kafe berhasil di-approve');
    }

    public function rejectCafe($cafeId)
    {
        $cafe = Cafe::findOrFail($cafeId);
        $cafe->update(['status' => 'rejected']);
        
        session()->flash('success', 'Kafe berhasil di-reject');
    }

    public function render()
    {
        $cafes = Cafe::pending()
            ->with(['primaryPhoto', 'facilities', 'vibes'])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.cafes.cafe-pending', [
            'cafes' => $cafes,
        ])->layout('components.admin-layout', ['title' => 'Kafe Pending']);
    }
}