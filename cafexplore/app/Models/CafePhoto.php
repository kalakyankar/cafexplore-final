<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CafePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'cafe_id',
        'url',
        'caption',
        'is_primary',
        'uploaded_by_user_id',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    // Relasi
    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by_user_id');
    }
}