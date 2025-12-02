<?php

namespace App\Livewire\Admin\Reviews;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Review;

class ReviewPending extends Component
{
    use WithPagination;

    public function approveReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update(['status' => 'approved']);
        
        session()->flash('success', 'Review berhasil di-approve');
    }

    public function rejectReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update(['status' => 'rejected']);
        
        session()->flash('success', 'Review berhasil di-reject');
    }

    public function render()
    {
        $reviews = Review::pending()
            ->with(['user', 'cafe'])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.reviews.review-pending', [
            'reviews' => $reviews,
        ])->layout('components.admin-layout', ['title' => 'Review Pending']);
    }
}