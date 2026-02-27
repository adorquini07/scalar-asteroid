<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    protected $fillable = [
        'nombre_votante',
        'nombre_lider',
        'ubicacion_id',
        'mesa',
        'voto_tipo',
        'user_id',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
