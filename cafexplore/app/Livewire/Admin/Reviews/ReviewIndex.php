<?php

namespace App\Livewire\Admin\Reviews;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Review;

class ReviewIndex extends Component
{
    use WithPagination;

    public $statusFilter = '';

    protected $queryString = ['statusFilter'];

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function deleteReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->delete();
        
        session()->flash('success', 'Review berhasil dihapus');
    }

    public function render()
    {
        $query = Review::with(['user', 'cafe']);

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $reviews = $query->latest()->paginate(20);

        return view('livewire.admin.reviews.review-index', [
            'reviews' => $reviews,
        ])->layout('components.admin-layout', ['title' => 'Kelola Review']);
    }
}