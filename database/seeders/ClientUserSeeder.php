<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Cliente Ejemplo',
            'email' => 'client@client.com',
            'password' => Hash::make('client123'),
            'role' => 'client',
            'phone' => '0987654321',
            'address' => 'Avenida Secundaria #456',
         
        ]);

        $this->command->info('Usuario cliente creado:');
        $this->command->info('Email: cliente@ecommerce.com');
        $this->command->info('Password: Cliente1234');
    }
}