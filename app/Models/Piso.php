<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_estante',
        'fecha_mant'
    ];

    public function estante()
    {
        return $this->belongsTo(Estante::class);
    }
    public function casillas()
    {
        return $this->hasMany(Casilla::class);
    }
}
