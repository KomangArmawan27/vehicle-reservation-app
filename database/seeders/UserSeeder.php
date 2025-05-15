<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => Hash::make('password'), // default password
            ],
            [
                'name' => 'Approver One',
                'email' => 'approver1@example.com',
                'role' => 'approver',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Approver Two',
                'email' => 'approver2@example.com',
                'role' => 'approver',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
