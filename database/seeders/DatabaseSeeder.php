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
            $this->call(AdminSeeder::class);
            $this->call(NotificationSeeder::class);

        // \App\Models\User::factory(10)->create();
        // Uncomment the line below to create 10 users using the User factory
        // This is useful for testing purposes, but you can comment it out in production.
        
        // Uncomment the line below to create 10 users using the User factory
        // This is useful for testing purposes, but you can comment it out in production.
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
