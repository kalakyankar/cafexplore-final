<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            ['name' => 'WiFi', 'icon' => 'wifi'],
            ['name' => 'Stopkontak', 'icon' => 'plug'],
            ['name' => 'AC', 'icon' => 'wind'],
            ['name' => 'Smoking Area', 'icon' => 'cigarette'],
            ['name' => 'Outdoor', 'icon' => 'sun'],
            ['name' => 'Parking', 'icon' => 'car'],
            ['name' => 'Musholla', 'icon' => 'mosque'],
            ['name' => 'Toilet', 'icon' => 'restroom'],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}