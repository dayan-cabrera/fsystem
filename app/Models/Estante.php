<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_almacen',
        'mant',
        'fecha_mant',
    ];
}
