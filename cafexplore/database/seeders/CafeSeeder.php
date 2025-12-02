<?php

namespace Database\Seeders;

use App\Models\Cafe;
use App\Models\CafePhoto;
use Illuminate\Database\Seeder;

class CafeSeeder extends Seeder
{
    public function run(): void
    {
        $cafe1 = Cafe::create([
            'name' => 'Kopi Kenangan',
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'description' => 'Kafe modern dengan konsep grab and go. Menyajikan kopi lokal berkualitas dengan harga terjangkau.',
            'latitude' => -6.208763,
            'longitude' => 106.845599,
            'price_range' => 'cheap',
            'cafe_operating_hours' => [
                'monday' => '08:00-22:00',
                'tuesday' => '08:00-22:00',
                'wednesday' => '08:00-22:00',
                'thursday' => '08:00-22:00',
                'friday' => '08:00-23:00',
                'saturday' => '08:00-23:00',
                'sunday' => '08:00-22:00',
            ],
            'is_closed' => false,
            'status' => 'approved',
            'phone' => '081234567890',
            'website' => 'https://kopikenangan.com',
        ]);

        CafePhoto::create([
            'cafe_id' => $cafe1->id,
            'url' => 'https://via.placeholder.com/800x600?text=Kopi+Kenangan',
            'caption' => 'Interior Kopi Kenangan',
            'is_primary' => true,
            'uploaded_by_user_id' => 1,
        ]);

        $cafe1->facilities()->attach([1, 2, 3, 6]); // WiFi, Stopkontak, AC, Parking
        $cafe1->vibes()->attach([2, 3]); // Modern, Minimalis

        $cafe2 = Cafe::create([
            'name' => 'Filosofi Kopi',
            'address' => 'Jl. Melawai Raya No. 10, Jakarta Selatan',
            'description' => 'Tempat favorit para pencinta kopi sejati. Menyajikan berbagai jenis kopi specialty dengan atmosfer yang cozy.',
            'latitude' => -6.243038,
            'longitude' => 106.797190,
            'price_range' => 'moderate',
            'cafe_operating_hours' => [
                'monday' => '10:00-22:00',
                'tuesday' => '10:00-22:00',
                'wednesday' => '10:00-22:00',
                'thursday' => '10:00-22:00',
                'friday' => '10:00-23:00',
                'saturday' => '09:00-23:00',
                'sunday' => '09:00-22:00',
            ],
            'is_closed' => false,
            'status' => 'approved',
            'phone' => '081234567891',
            'website' => null,
        ]);

        CafePhoto::create([
            'cafe_id' => $cafe2->id,
            'url' => 'https://via.placeholder.com/800x600?text=Filosofi+Kopi',
            'caption' => 'Suasana Filosofi Kopi',
            'is_primary' => true,
            'uploaded_by_user_id' => 1,
        ]);

        $cafe2->facilities()->attach([1, 2, 3, 4, 7]); // WiFi, Stopkontak, AC, Smoking, Musholla
        $cafe2->vibes()->attach([1, 5]); // Cozy, Rustic

        $cafe3 = Cafe::create([
            'name' => 'Tanamera Coffee',
            'address' => 'Jl. Kemang Raya No. 5, Jakarta Selatan',
            'description' => 'Kafe premium dengan pemandangan taman yang asri. Perfect untuk meeting atau sekadar bersantai.',
            'latitude' => -6.266203,
            'longitude' => 106.815254,
            'price_range' => 'expensive',
            'cafe_operating_hours' => [
                'monday' => '09:00-21:00',
                'tuesday' => '09:00-21:00',
                'wednesday' => '09:00-21:00',
                'thursday' => '09:00-21:00',
                'friday' => '09:00-22:00',
                'saturday' => '09:00-22:00',
                'sunday' => '09:00-21:00',
            ],
            'is_closed' => false,
            'status' => 'approved',
            'phone' => '081234567892',
            'website' => 'https://tanameracoffee.com',
        ]);

        CafePhoto::create([
            'cafe_id' => $cafe3->id,
            'url' => 'https://via.placeholder.com/800x600?text=Tanamera+Coffee',
            'caption' => 'Outdoor area Tanamera',
            'is_primary' => true,
            'uploaded_by_user_id' => 1,
        ]);

        $cafe3->facilities()->attach([1, 2, 3, 5, 6, 7, 8]); // All facilities
        $cafe3->vibes()->attach([2, 4, 8]); // Modern, Aesthetic, Nature
    }
}