<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'title',
        'slug',
        'description',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Relasi
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function cafes()
    {
        return $this->belongsToMany(Cafe::class, 'collection_cafes')
            ->withPivot('sort_order')
            ->orderBy('sort_order')
            ->withTimestamps();
    }

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->title);
            }
        });
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}