<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casilla extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_piso',
        'mant',
        'ocupada',
        'fecha_mant'
    ];
}
