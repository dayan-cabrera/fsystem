<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'fechaexp',
        'id_tipoprod',
        'id_empaquetado',
        'id_compania',
        'id_casilla',
        'id_cliente',
        'condrefrig',
        'peso'
    ];

    protected $cats = [
        'fechaexp' => 'string',
    ];

    public function casilla()
    {
        return $this->belongsTo(Casilla::class);
    }
}
