<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Product::create([
            'name' => 'Teclado mecánico',
            'price' => 49.99,
        ]);

        Product::create([
            'name' => 'Mouse gamer',
            'price' => 25.00,
        ]);

        Product::create([
            'name' => 'Monitor LED 24"',
            'price' => 120.00,
        ]);
        
    }
}
