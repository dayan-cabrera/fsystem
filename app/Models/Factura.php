<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_empresa',
        'id_cliente',
        'tarifa_tr',
        'tarifa_peso',
        'tarifa_tiempo',
        'tarifa_refr',
        'tarifa_af',
        'fecha_acordada',
        'fecha_entrada',
        'fecha_salida',
        'archivado'
    ];
}
