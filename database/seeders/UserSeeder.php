<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create specific test users
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567890',
            'role' => 'admin',
            'image' => 'https://via.placeholder.com/100x100/007bff/ffffff?text=Admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Property Host',
            'email' => 'host@example.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567891',
            'role' => 'host',
            'image' => 'https://via.placeholder.com/100x100/28a745/ffffff?text=Host',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Regular Guest',
            'email' => 'guest@example.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567892',
            'role' => 'guest',
            'image' => 'https://via.placeholder.com/100x100/6c757d/ffffff?text=Guest',
            'email_verified_at' => now(),
        ]);

        // Create multiple hosts for properties
        User::factory()->count(8)->host()->create();

        // Create regular guests
        User::factory()->count(15)->guest()->create();

        // Create one more admin
        User::factory()->count(1)->admin()->create();
    }
}