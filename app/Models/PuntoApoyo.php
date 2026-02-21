<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntoApoyo extends Model
{
    protected $table = 'puntos_apoyo';

    protected $fillable = ['nombre'];

    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class, 'punto_apoyo_id');
    }
}
