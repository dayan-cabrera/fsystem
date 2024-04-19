<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_almacen',
        'fecha_mant',
    ];

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }
    public function pisos()
    {
        return $this->hasMany(Piso::class);
    }
}
