<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Cafexplore',
            'email' => 'admin@cafexplore.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'bio' => 'Administrator Cafexplore',
        ]);

        // Member
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'bio' => 'Coffee enthusiast & digital nomad',
        ]);

        User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'bio' => 'Love exploring new cafes',
        ]);
    }
}