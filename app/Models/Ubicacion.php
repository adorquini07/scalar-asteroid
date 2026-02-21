<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';

    protected $fillable = [
        'nombre',
        'total_mesas',
        'punto_apoyo_id',
    ];

    public function puntoApoyo()
    {
        return $this->belongsTo(PuntoApoyo::class, 'punto_apoyo_id');
    }

    public function registros()
    {
        return $this->hasMany(Registro::class);
    }
}
