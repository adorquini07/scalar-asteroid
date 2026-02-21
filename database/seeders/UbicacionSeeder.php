<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ubicaciones = [
            'Base Central',
            'Punto Norte - Calle 80',
            'Punto Sur - Av. Américas',
            'Punto Este - Autopista Norte',
            'Punto Oeste - Av. Boyacá',
            'Centro Histórico',
            'Zona Industrial',
            'Terminal de Transportes',
            'Aeropuerto',
            'Plaza Principal',
        ];

        foreach ($ubicaciones as $nombre) {
            \App\Models\Ubicacion::firstOrCreate(['nombre' => $nombre]);
        }

        $this->command->info('Ubicaciones creadas exitosamente!');
    }
}
