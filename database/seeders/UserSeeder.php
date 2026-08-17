<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admin
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000000',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],

            // Hosts
            [
                'name' => 'Sophie Martin',
                'email' => 'sophie.host@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000001',
                'password' => Hash::make('password'),
                'role' => 'host',
            ],
            [
                'name' => 'Adam Johnson',
                'email' => 'adam.host@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000002',
                'password' => Hash::make('password'),
                'role' => 'host',
            ],
            [
                'name' => 'Emma Williams',
                'email' => 'emma.host@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000003',
                'password' => Hash::make('password'),
                'role' => 'host',
            ],
            [
                'name' => 'Lucas Brown',
                'email' => 'lucas.host@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000004',
                'password' => Hash::make('password'),
                'role' => 'host',
            ],
            [
                'name' => 'Olivia Taylor',
                'email' => 'olivia.host@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000005',
                'password' => Hash::make('password'),
                'role' => 'host',
            ],

            // Guests
            [
                'name' => 'Youssef Alaoui',
                'email' => 'youssef@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000006',
                'password' => Hash::make('password'),
                'role' => 'guest',
            ],
            [
                'name' => 'Sarah Bennett',
                'email' => 'sarah@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000007',
                'password' => Hash::make('password'),
                'role' => 'guest',
            ],
            [
                'name' => 'Omar El Amrani',
                'email' => 'omar@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000008',
                'password' => Hash::make('password'),
                'role' => 'guest',
            ],
            [
                'name' => 'Nora Wilson',
                'email' => 'nora@example.com',
                'email_verified_at' => now(),
                'phone' => '+212600000009',
                'password' => Hash::make('password'),
                'role' => 'guest',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}