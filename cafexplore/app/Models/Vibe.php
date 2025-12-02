<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vibe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relasi
    public function cafes()
    {
        return $this->belongsToMany(Cafe::class, 'cafe_vibes')->withTimestamps();
    }
}