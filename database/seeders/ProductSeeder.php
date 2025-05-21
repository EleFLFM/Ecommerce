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
            'name' => 'Conjunto dama',
            'price' => 82000,
            'stock' => 10,
            'description' => 'Nueva colección de Set ✨ REF VIVIANA 🎀.',
            'image' => '',
            'category_id' => 1,

        ]);
        // Product::create([
        //     'name' => 'Camisa de mezclilla',
        //     'price' => 39.99,
        //     'stock' => 5,
        //     'description' => 'Camisa de mezclilla clásica.',
        //     // 'image' => 'https://example.com/camisa-mezclilla.jpg',
           
        //     'category_id' => 2,
        // ]);
        // Product::create([   
        //     'name' => 'Pantalones cortos',
        //     'price' => 29.99,
        //     'stock' => 8,
        //     'description' => 'Pantalones cortos de algodón.',
        //     // 'image' => 'https://example.com/pantalones-cortos.jpg',
          
        //     'category_id' => 3,
        // ]);
        // Product::create([
        //     'name' => 'Zapatos deportivos',
        //     'price' => 69.99,
        //     'stock' => 15,
        //     'description' => 'Zapatos deportivos cómodos.',
        //     // 'image' => 'https://example.com/zapatos-deportivos.jpg',
          
        //     'category_id' => 4,
        // ]);
    
        
    }
}
