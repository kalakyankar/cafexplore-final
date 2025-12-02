<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'bio',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Cafe::class, 'bookmarks')->withTimestamps();
    }

    public function uploadedPhotos()
    {
        return $this->hasMany(CafePhoto::class, 'uploaded_by_user_id');
    }

    public function collections()
    {
        return $this->hasMany(Collection::class, 'admin_id');
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isMember()
    {
        return $this->role === 'member';
    }

    public function hasBookmarked($cafeId)
    {
        return $this->bookmarks()->where('cafe_id', $cafeId)->exists();
    }
}