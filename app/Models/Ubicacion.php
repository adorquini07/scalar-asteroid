<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';

    protected $fillable = [
        'nombre',
    ];

    public function registros()
    {
        return $this->hasMany(Registro::class);
    }
}
