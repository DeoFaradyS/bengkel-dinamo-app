<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Servis Dinamo Starter', 'price_min' => 50000, 'price_max' => 150000, 'estimated_time_minutes' => 60, 'available_home_service' => true],
            ['name' => 'Servis Dinamo Ampere', 'price_min' => 50000, 'price_max' => 150000, 'estimated_time_minutes' => 60, 'available_home_service' => true],
            ['name' => 'Ganti Aki', 'price_min' => 20000, 'price_max' => 50000, 'estimated_time_minutes' => 20, 'available_home_service' => true],
            ['name' => 'Perbaikan Kelistrikan', 'price_min' => 30000, 'price_max' => 200000, 'estimated_time_minutes' => 90, 'available_home_service' => false],
            ['name' => 'Servis Kabel & Konektor', 'price_min' => 15000, 'price_max' => 60000, 'estimated_time_minutes' => 30, 'available_home_service' => false],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}