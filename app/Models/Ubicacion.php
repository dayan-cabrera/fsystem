<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod_casilla',
        'cod_carga',
        'fecha_salida',
        'fecha_salida_real',
        'fecha_entrada',
    ];
}
