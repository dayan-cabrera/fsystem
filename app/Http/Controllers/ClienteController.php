<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compania;
use App\Models\TipoEmpaquetado;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {
        // getCliente
        $clientes = Cliente::orderBy('nombre')->get();
        return view('cliente.index', compact('clientes'));
    }

    public function create()
    {

        $casillas = DB::table('casillas')
            ->join('pisos', 'casillas.id_piso', '=', 'pisos.id')
            ->join('estantes', 'pisos.id_estante', '=', 'estantes.id')
            ->join('almacens', 'estantes.id_almacen', '=', 'almacens.id')
            ->where('casillas.ocupada', false)
            ->where('casillas.mant', false)
            ->where('pisos.mant', false)
            ->where('estantes.mant', false)
            ->where('almacens.mantorep', false)
            ->select(
                'casillas.id as id',
                'almacens.nombre as almacen',
                'estantes.id as estante',
                'pisos.id as piso'
            )->get();


        if (count($casillas) == 0) return back()->with('error', 'No hay casillas disponibles');
        return view('cliente.create');
    }

    public function store(Request $request)
    {
        // insertarCliente

        $cliente = $request->validate([
            'nombre' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'fax' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'anos' => 'required|string|min:0',
            'prioridad' => 'boolean',
            'entidad' => 'boolean'
        ]);

        // datos necesarios para l acreacion de la carga:
        $tipos_productos = TipoProducto::select('id', 'tipo')->get();
        $tipos_empaquetado = TipoEmpaquetado::select('id', 'tipo')->get();
        $clientes = Cliente::select('id', 'nombre')->get();
        $companias = Compania::select('id', 'nombre')->get();
        // Seleccionar ubicaciones disponibles
        $casillas = DB::table('casillas')
            ->join('pisos', 'casillas.id_piso', '=', 'pisos.id')
            ->join('estantes', 'pisos.id_estante', '=', 'estantes.id')
            ->join('almacens', 'estantes.id_almacen', '=', 'almacens.id')
            ->where('casillas.ocupada', false)
            ->where('casillas.mant', false)
            ->where('pisos.mant', false)
            ->where('estantes.mant', false)
            ->where('almacens.mantorep', false)
            ->select(
                'casillas.id as id',
                'almacens.nombre as almacen',
                'estantes.id as estante',
                'pisos.id as piso'
            )->get();


        // if (count($casillas) == 0) return back()->with('error', 'No hay casillas disponibles');

        return view('carga.create', compact('tipos_productos', 'tipos_empaquetado', 'clientes', 'companias', 'casillas', 'cliente'));
    }

    public function destroy($id)
    {
        // eliminarCliente
        Cliente::destroy($id);
        return redirect()->route('cliente.index');
    }
}
