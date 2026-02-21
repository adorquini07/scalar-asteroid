<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PuntoApoyo;

class PuntosApoyoSeeder extends Seeder
{
    public function run(): void
    {
        $puntos = [
            ['nombre' => 'Punto de Apoyo 1'],
            ['nombre' => 'Punto de Apoyo 2'],
            ['nombre' => 'Punto de Apoyo 3'],
            ['nombre' => 'Punto de Apoyo 4'],
            ['nombre' => 'Punto de Apoyo 5'],
            ['nombre' => 'Punto de Apoyo 6'],
            ['nombre' => 'Punto de Apoyo 7'],
        ];

        foreach ($puntos as $punto) {
            PuntoApoyo::firstOrCreate(['nombre' => $punto['nombre']]);
        }
    }
}
