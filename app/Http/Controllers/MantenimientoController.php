<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Estante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MantenimientoController extends Controller
{
    public function index()
    {
        $almacenes = Almacen::where('mantorep', true)->paginate(5);

        $estantes = DB::table('estantes')->join('almacens', 'estantes.id_almacen', '=', 'almacens.id')
            ->where('estantes.mant', true)->where('almacens.mantorep', false)
            ->select('estantes.id', 'almacens.nombre as almacen', 'estantes.mant', 'estantes.fecha_mant')
            ->paginate(5);

        $pisos = DB::table('pisos')->join('estantes', 'pisos.id_estante', '=', 'estantes.id')
            ->join('almacens', 'estantes.id_almacen', '=', 'almacens.id')
            ->where('pisos.mant', true)->where('estantes.mant', false)
            ->where('almacens.mantorep', false)
            ->select('pisos.id', 'estantes.id as estante', 'pisos.mant', 'pisos.fecha_mant')
            ->paginate(5);

        $casillas = DB::table('casillas')->join('pisos', 'casillas.id_piso', '=', 'pisos.id')
            ->join('estantes', 'pisos.id_estante', '=', 'estantes.id')
            ->join('almacens', 'estantes.id_almacen', '=', 'almacens.id')
            ->where('casillas.mant', true)->where('pisos.mant', false)
            ->where('estantes.mant', false)->where('almacens.mantorep', false)
            ->select('casillas.id', 'pisos.id as piso', 'casillas.mant', 'casillas.fecha_mant')
            ->paginate(5);

        return view('mantenimiento.index', compact('almacenes', 'estantes', 'pisos', 'casillas'));
    }
}
