<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cafe;
use App\Models\Collection;

class HomePage extends Component
{
    public function render()
    {
        $featuredCafes = Cafe::approved()
            ->open()
            ->with(['primaryPhoto', 'facilities', 'vibes'])
            ->withCount('reviews')
            ->latest()
            ->take(6)
            ->get();

        $collections = Collection::published()
            ->with(['cafes' => function($query) {
                $query->take(3);
            }])
            ->latest()
            ->take(3)
            ->get();

        return view('livewire.home-page', [
            'featuredCafes' => $featuredCafes,
            'collections' => $collections,
        ])->layout('components.layout', ['title' => 'Beranda']);
    }
}