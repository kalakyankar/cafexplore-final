<?php

namespace App\Livewire\Bookmarks;

use Livewire\Component;
use Livewire\WithPagination;

class BookmarkIndex extends Component
{
    use WithPagination;

    public function removeBookmark($cafeId)
    {
        auth()->user()->bookmarks()->detach($cafeId);
        session()->flash('success', 'Kafe dihapus dari bookmark');
    }

    public function render()
    {
        $bookmarks = auth()->user()
            ->bookmarks()
            ->with(['primaryPhoto', 'facilities', 'vibes'])
            ->withCount('reviews')
            ->paginate(12);

        return view('livewire.bookmarks.bookmark-index', [
            'bookmarks' => $bookmarks,
        ])->layout('components.layout', ['title' => 'Bookmark Saya']);
    }
}