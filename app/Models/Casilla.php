<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casilla extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_piso',
        'fecha_mant'
    ];

    public function piso()
    {
        return $this->belongsTo(Piso::class);
    }
    public function cargas()
    {
        return $this->hasMany(Carga::class);
    }
}
