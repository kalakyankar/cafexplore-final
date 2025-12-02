<?php

namespace Database\Seeders;

use App\Models\Vibe;
use Illuminate\Database\Seeder;

class VibeSeeder extends Seeder
{
    public function run(): void
    {
        $vibes = [
            'Cozy',
            'Modern',
            'Minimalis',
            'Aesthetic',
            'Rustic',
            'Industrial',
            'Vintage',
            'Nature',
            'Romantic',
            'Casual',
        ];

        foreach ($vibes as $vibe) {
            Vibe::create(['name' => $vibe]);
        }
    }
}