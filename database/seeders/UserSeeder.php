<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un usuario administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            // Otros campos si los necesitas
        ]);

        // Puedes agregar más usuarios si es necesario
        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@example.com',
            'password' => Hash::make('password'),
            // Otros campos si los necesitas
        ]);
    }
}
