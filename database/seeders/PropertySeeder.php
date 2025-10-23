<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create some users to associate with properties
        $users = User::factory()->count(5)->create();

        // Create properties with random users
        Property::factory()->count(20)->create();

        // Create some specific types of properties
        Property::factory()->count(5)->expensive()->create();
        Property::factory()->count(5)->affordable()->create();
        Property::factory()->count(3)->largeCapacity()->create();

        // You can also create properties for specific users
        $specificUser = User::first();
        if ($specificUser) {
            Property::factory()->count(3)->create([
                'user_id' => $specificUser->id,
            ]);
        }
    }
}