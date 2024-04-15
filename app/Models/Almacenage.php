<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacenage extends Model
{
    use HasFactory;

    protected $fillable = [
        'mant',
        'ocupado',
        'fecha_mant',
    ];

    protected $casts = [
        'mant' => 'boolean',
        'ocupado' => 'boolean',
    ];
}
