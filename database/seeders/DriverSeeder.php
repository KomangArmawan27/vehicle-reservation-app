<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            [
                'name' => 'Komang Surya',
                'license_number' => 'B12345678',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 1, Denpasar',
                'is_available' => true,
            ],
            [
                'name' => 'Made Sugiarta',
                'license_number' => 'B87654321',
                'phone' => '081298765432',
                'address' => 'Jl. Teuku Umar, Denpasar',
                'is_available' => false,
            ],
            [
                'name' => 'Kadek Arya',
                'license_number' => 'D44556677',
                'phone' => '082233445566',
                'address' => 'Jl. Gatot Subroto, Denpasar',
                'is_available' => true,
            ],
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}
