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
            'name' => 'Vestido floral',
            'price' => 49.99,
            'category_id' => 1,

        ]);

        Product::create([
            'name' => 'Blusa elegante',
            'price' => 25.00,
            'category_id' => 1,

        ]);

        Product::create([
            'name' => 'Pantalón lino',
            'price' => 120.00,
            'category_id' => 1,

        ]);
        Product::create([
            'name' => 'Falda mini',
            'price' => 120.00,
            'category_id' => 1,
        ]);
        
        
    }
}
