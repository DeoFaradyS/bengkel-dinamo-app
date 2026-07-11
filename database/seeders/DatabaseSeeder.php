<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WorkshopSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Admin Budi Dinamo',
            'email' => 'admin@bengkeldinamo.test',
            'password' => bcrypt('password'),
        ]);

        WorkshopSetting::create([
            'latitude' => -7.7174465,
            'longitude' => 113.0755426,
            'max_service_radius_km' => 5,
            'default_home_service_fee' => 20000,
            'updated_at' => now(),
        ]);

        $this->call([
            CategorySeeder::class,
            ServiceSeeder::class,
            SparePartSeeder::class,
        ]);
    }
}