<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'name' => 'Toyota Avanza',
                'type' => 'passenger',
                'ownership' => 'company',
                'license_plate' => 'B 1234 ABC',
            ],
            [
                'name' => 'Mitsubishi L300',
                'type' => 'cargo',
                'ownership' => 'rented',
                'license_plate' => 'D 5678 DEF',
            ],
            [
                'name' => 'Suzuki Carry',
                'type' => 'cargo',
                'ownership' => 'company',
                'license_plate' => 'F 9101 GHI',
            ],
            [
                'name' => 'Isuzu Elf',
                'type' => 'passenger',
                'ownership' => 'rented',
                'license_plate' => 'Z 1213 JKL',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
