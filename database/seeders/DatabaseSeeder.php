<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'fonction' => 'Administrator',
            'tele' => '1234567890',
            'userName' => 'admin',
            'mac' => '00:1A:2B:3C:4D:5E',
            'strg1' => 'Admin Center',
            'strg2' => 'Admin Processing',
            'strg3' => 'Admin Registration',
            'strg4' => 'Admin Incompatibility'
        ]);

        // Create regular test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'fonction' => 'Regular User',
            'tele' => '0987654321',
            'userName' => 'testuser',
            'mac' => '00:1A:2B:3C:4D:5F',
            'strg1' => 'User Center',
            'strg2' => 'User Processing',
            'strg3' => 'User Registration',
            'strg4' => 'User Incompatibility'
        ]);

        // Create additional users if needed
        // User::factory(10)->create();
    }
}
