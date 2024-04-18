<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;
use Illuminate\Http\Request;
// use App\Models\Auxi;
use App\Models\Carga;
use App\Models\Casilla;
use App\Models\Cliente;
use App\Models\Compania;
use App\Models\TipoEmpaquetado;
use Illuminate\Support\Facades\DB;

class CargaController extends Controller
{
    // public function getTipoP()
    // {
    //     $tipos = TipoProducto::select('nombre')->get();
    //     return view('carga.producto', compact('tipos'));
    // }

    // public function getTipoEmp()
    // {
    //     $tipos = TipoEmpaquetado::select('tipo')->get();
    //     return view('carga.empaquetado', compact('tipos'));
    // }

    public function index() 
    {
        // getCargas

        $cargas = DB::table('cargas')
                    ->join('tipo_productos', 'cargas.id_tipoprod', '=', 'tipo_productos.id')
                    ->join('tipo_empaquetados', 'cargas.id_empaquetado', '=', 'tipo_empaquetados.id')
                    ->join('companias', 'cargas.id_compania', '=', 'companias.id')
                    ->join('casillas', 'cargas.id_casilla', '=', 'casillas.id')
                    ->join('clientes', 'cargas.id_cliente', '=', 'clientes.id')
                    ->select('cargas.id', 'cargas.nombre', 'cargas.codigo', 'cargas.fechaexp', 'tipo_productos.tipo as tipo_producto', 'tipo_empaquetados.tipo as empaquetado', 'companias.nombre as compania', 'id_casilla', 'clientes.nombre as cliente', 'cargas.condrefrig', 'cargas.peso')
                    ->get();

        return view('carga.index', compact('cargas'));
    }

    public function create() {
        $tipos_productos = TipoProducto::select('id', 'tipo')->get(); 
        $tipos_empaquetado = TipoEmpaquetado::select('id', 'tipo')->get(); 
        $clientes = Cliente::select('id', 'nombre')->get();
        $companias = Compania::select('id', 'nombre')->get();
        $casillas = Casilla::select('id')->get();

        return view('carga.create', compact('tipos_productos', 'tipos_empaquetado', 'clientes', 'companias', 'casillas'));
    }

    public function edit($id) {
        $carga = Carga::findOrFail($id);
        $tipos_productos = TipoProducto::select('id', 'tipo')->get(); 
        $tipos_empaquetado = TipoEmpaquetado::select('id', 'tipo')->get(); 
        $clientes = Cliente::select('id', 'nombre')->get();
        $companias = Compania::select('id', 'nombre')->get();
        $casillas = Casilla::select('id')->get();

        return view('carga.edit', compact('carga','tipos_productos', 'tipos_empaquetado', 'clientes', 'companias', 'casillas'));
    }

    public function store(Request $request)
    {
        // insertarCarga
        $data = $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'fechaexp' => 'required',
            'id_tipoprod' => 'required',
            'id_empaquetado' => 'required',
            'id_compania' => 'required',
            'id_casilla' => 'required',
            'id_cliente' => 'required',
            'condrefrig' => 'required',
            'peso' => 'required'
        ]);

        Carga::create($data);
        return redirect()->route('carga.index')->with('success', 'Carga creada exitosamente');
    }

    public function update(Request $request, $id)
    {
        // cambiar carga de casilla,modificarCarga$codCarga, $codCasilla)

        $data = $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'fechaexp' => 'required',
            'id_tipoprod' => 'required',
            'id_empaquetado' => 'required',
            'id_compania' => 'required',
            'id_casilla' => 'required',
            'id_cliente' => 'required',
            'condrefrig' => 'required',
            'peso' => 'required'
        ]);

        $carga = Carga::findOrFail($id);
        $carga->update($data);

        return redirect()->route('carga.index')->with('success', 'Carga creada exitosamente');
    }

    public function destroy($codCarga)
    {
        Carga::where('id', $codCarga)->delete();
        return redirect()->route('carga.index')->with('success', 'Carga eliminada correctamente');
    }

    // public function modificarFechas($codCarga, $codCasilla)
    // {
    //     DB::table('factura')
    //         ->where('id', $codCarga)
    //         ->update([
    //             'cod_casilla' => $codCasilla,
    //             'fecha_salida' => $codCasilla,
    //             'fecha_salida_real' => $codCasilla,
    //         ]);
    //     return redirect()->route('cargas.index')->with('success', 'Fechas modificadas correctamente');
    // }
}