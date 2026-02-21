<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Administrador
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mototrack.com',
            'password' => bcrypt('password'),
            'rol' => 'admin',
        ]);

        // Registradora
        User::create([
            'name' => 'Registradora Test',
            'email' => 'reg@mototrack.com',
            'password' => bcrypt('password'),
            'rol' => 'registradora',
        ]);

        // Visor
        User::create([
            'name' => 'Visor Test',
            'email' => 'visor@mototrack.com',
            'password' => bcrypt('password'),
            'rol' => 'visor',
        ]);

        // Ubicaciones / Puntos de Apoyo de prueba
        \App\Models\Ubicacion::create(['nombre' => 'Puesto Norte - 7 de Agosto']);
        \App\Models\Ubicacion::create(['nombre' => 'Puesto Sur - Centro']);
        \App\Models\Ubicacion::create(['nombre' => 'Base Principal']);

        // Personas/Motos de prueba
        \App\Models\Persona::create([
            'cedula' => '123456789',
            'nombre' => 'Adrián',
            'apodo' => 'El Rápido',
            'celular' => '3001234567',
            'placa' => 'ABC-12D',
        ]);

        \App\Models\Persona::create([
            'cedula' => '987654321',
            'nombre' => 'Nuvis',
            'apodo' => 'La Jefa',
            'celular' => '3009876543',
            'placa' => 'XYZ-98W',
        ]);

        \App\Models\Persona::create([
            'cedula' => '1122334455',
            'nombre' => 'Julia',
            'apodo' => 'Julita',
            'celular' => '3211122334',
            'placa' => 'MTO-555',
        ]);
    }
}
