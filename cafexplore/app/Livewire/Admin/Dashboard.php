<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Cafe;
use App\Models\Review;
use App\Models\User;
use App\Models\Collection;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_cafes' => Cafe::count(),
            'approved_cafes' => Cafe::approved()->count(),
            'pending_cafes' => Cafe::pending()->count(),
            'total_reviews' => Review::count(),
            'pending_reviews' => Review::pending()->count(),
            'approved_reviews' => Review::approved()->count(),
            'total_users' => User::where('role', 'member')->count(),
            'total_collections' => Collection::count(),
        ];

        $recentCafes = Cafe::with('primaryPhoto')
            ->latest()
            ->take(5)
            ->get();

        $recentReviews = Review::with(['user', 'cafe'])
            ->latest()
            ->take(5)
            ->get();

        $popularCollections = Collection::withCount('cafes')
            ->orderByDesc('cafes_count')
            ->take(5)
            ->get();

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'recentCafes' => $recentCafes,
            'recentReviews' => $recentReviews,
            'popularCollections' => $popularCollections,
        ])->layout('components.admin-layout', ['title' => 'Dashboard']);
    }
}