<?php

namespace Database\Seeders;
use Database\Seeders\ProductSeeder;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\ClientUserSeeder;



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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            ProductSeeder::class,
            AdminUserSeeder::class,
            ClientUserSeeder::class,
        ]);
    }
}
