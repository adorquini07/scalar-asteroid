<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'cedula',
        'nombre',
        'apodo',
        'celular',
        'placa',
        'puesto_votacion',
        'mesa_votacion',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function registros()
    {
        return $this->hasMany(Registro::class);
    }

    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }

    public function getUltimoRegistroAttribute()
    {
        return $this->registros()->latest()->first();
    }
}
