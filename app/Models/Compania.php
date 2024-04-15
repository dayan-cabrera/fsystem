<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compania extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tipocomp',
        'id_seguridad',
        'id_condalm',
        'id_prioridad',
        'id_empresa',
        'nombre'
    ];

}
