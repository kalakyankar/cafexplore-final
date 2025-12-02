<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Cafe;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada admin dan cafe approved
        $admin = \App\Models\User::where('role', 'admin')->first();
        $cafes = Cafe::approved()->get();

        if (!$admin || $cafes->count() < 2) {
            $this->command->warn('Seeder membutuhkan minimal 1 admin user dan 2 cafe approved');
            return;
        }

        // Collection 1
        $collection1 = Collection::create([
            'admin_id' => $admin->id,
            'title' => 'Kafe Terbaik untuk Working',
            'description' => 'Koleksi kafe dengan WiFi stabil, stopkontak banyak, dan suasana tenang yang cocok untuk produktivitas maksimal.',
            'is_published' => true,
        ]);

        // Attach 2-3 cafes
        $selectedCafes = $cafes->take(3);
        foreach ($selectedCafes as $index => $cafe) {
            $collection1->cafes()->attach($cafe->id, ['sort_order' => $index]);
        }

        // Collection 2
        $collection2 = Collection::create([
            'admin_id' => $admin->id,
            'title' => 'Kafe Instagramable Jakarta',
            'description' => 'Temukan kafe dengan interior aesthetic dan spot foto menarik di Jakarta.',
            'is_published' => true,
        ]);

        $selectedCafes2 = $cafes->skip(1)->take(2);
        foreach ($selectedCafes2 as $index => $cafe) {
            $collection2->cafes()->attach($cafe->id, ['sort_order' => $index]);
        }

        $this->command->info('Collection seeder completed!');
    }
}