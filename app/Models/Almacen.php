<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_empresa',
        'condrefrigerado',
        'nombre',
        'mantorep',
        'fecha_mant'
    ];
}