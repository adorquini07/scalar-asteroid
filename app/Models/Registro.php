<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'user_id',
        'referido',
        'punto_apoyo_id',
        'ubicacion_id',
        'mesa_vota',
        'tipo',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function puntoApoyo()
    {
        return $this->belongsTo(PuntoApoyo::class);
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }
}
