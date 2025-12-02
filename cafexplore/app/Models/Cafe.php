<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'description',
        'latitude',
        'longitude',
        'price_range',
        'cafe_operating_hours',
        'is_closed',
        'status',
        'phone',
        'website',
    ];

    protected $casts = [
        'cafe_operating_hours' => 'array',
        'is_closed' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Relasi
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function photos()
    {
        return $this->hasMany(CafePhoto::class);
    }

    public function primaryPhoto()
    {
        return $this->hasOne(CafePhoto::class)->where('is_primary', true);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'cafe_facilities')
            ->withPivot('is_halal')
            ->withTimestamps();
    }

    public function vibes()
    {
        return $this->belongsToMany(Vibe::class, 'cafe_vibes')->withTimestamps();
    }

    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_cafes')
            ->withPivot('sort_order')
            ->withTimestamps();
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeOpen($query)
    {
        return $query->where('is_closed', false);
    }

    // Helper methods
    public function averageRating()
    {
        return $this->reviews()->where('status', 'approved')->avg('rating') ?? 0;
    }

    public function totalReviews()
    {
        return $this->reviews()->where('status', 'approved')->count();
    }

    public function getPriceRangeLabel()
    {
        return match($this->price_range) {
            'cheap' => 'Rp',
            'moderate' => 'Rp Rp',
            'expensive' => 'Rp Rp Rp',
            default => '-',
        };
    }
}