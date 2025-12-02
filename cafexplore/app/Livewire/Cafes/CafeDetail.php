<?php

namespace App\Livewire\Cafes;

use Livewire\Component;
use App\Models\Cafe;
use App\Models\Review;

class CafeDetail extends Component
{
    public Cafe $cafe;
    public $reviewContent = '';
    public $rating = 5;
    public $showReviewForm = false;

    protected $rules = [
        'reviewContent' => 'required|min:10|max:1000',
        'rating' => 'required|integer|min:1|max:5',
    ];

    public function mount($cafe)
    {
        $this->cafe = Cafe::with([
            'photos',
            'facilities',
            'vibes',
            'reviews' => function($query) {
                $query->approved()
                      ->with('user')
                      ->latest()
                      ->take(10);
            }
        ])->findOrFail($cafe);

        // Check if cafe is approved
        if ($this->cafe->status !== 'approved' && (!auth()->check() || !auth()->user()->isAdmin())) {
            abort(404);
        }
    }

    public function toggleBookmark()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        if ($user->hasBookmarked($this->cafe->id)) {
            $user->bookmarks()->detach($this->cafe->id);
            session()->flash('success', 'Kafe dihapus dari bookmark');
        } else {
            $user->bookmarks()->attach($this->cafe->id);
            session()->flash('success', 'Kafe ditambahkan ke bookmark');
        }
    }

    public function submitReview()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate();

        // Check if user already reviewed this cafe
        $existingReview = Review::where('user_id', auth()->id())
            ->where('cafe_id', $this->cafe->id)
            ->first();

        if ($existingReview) {
            session()->flash('error', 'Anda sudah memberikan review untuk kafe ini');
            return;
        }

        Review::create([
            'user_id' => auth()->id(),
            'cafe_id' => $this->cafe->id,
            'content' => $this->reviewContent,
            'rating' => $this->rating,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Review Anda berhasil dikirim dan menunggu persetujuan admin');
        
        $this->reset(['reviewContent', 'rating', 'showReviewForm']);
        $this->rating = 5;
    }

    public function render()
    {
        $userHasReviewed = auth()->check() 
            ? Review::where('user_id', auth()->id())
                    ->where('cafe_id', $this->cafe->id)
                    ->exists()
            : false;

        return view('livewire.cafes.cafe-detail', [
            'userHasReviewed' => $userHasReviewed,
        ])->layout('components.layout', ['title' => $this->cafe->name]);
    }
}