<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    public function run()
    {
        // Desactivar revisión de claves foráneas para mejor performance
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Size::truncate(); // Limpiar tabla primero
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $sizes = [
            [
                'name' => 'XS', 
                'description' => 'Extra Small',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'S', 
                'description' => 'Small',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'M', 
                'description' => 'Medium',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'L', 
                'description' => 'Large',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'XL', 
                'description' => 'Extra Large',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'XXL', 
                'description' => 'Double Extra Large',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        
        // Insertar usando inserción masiva más eficiente
        Size::insert($sizes);
        
        $this->command->info('Tallas creadas exitosamente!');
    }
}