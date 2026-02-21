<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

App\Models\Ubicacion::firstOrCreate(['nombre' => 'Puesto Norte - 7 de Agosto']);
App\Models\Ubicacion::firstOrCreate(['nombre' => 'Puesto Sur - Centro']);
App\Models\Ubicacion::firstOrCreate(['nombre' => 'Base Principal']);

echo "Ubicaciones creadas exitosamente.\n";
