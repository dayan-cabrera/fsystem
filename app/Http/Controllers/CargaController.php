<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;
use Illuminate\Http\Request;
use App\Models\Carga;
use App\Models\Casilla;
use App\Models\Cliente;
use App\Models\Compania;
use App\Models\Empresa;
use App\Models\Factura;
use App\Models\TipoEmpaquetado;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CargaController extends Controller
{
    public function index()
    {

        $cargas = DB::table('cargas')
            ->join('tipo_productos', 'cargas.id_tipoprod', '=', 'tipo_productos.id')
            ->join('tipo_empaquetados', 'cargas.id_empaquetado', '=', 'tipo_empaquetados.id')
            ->join('companias', 'cargas.id_compania', '=', 'companias.id')
            ->join('casillas', 'cargas.id_casilla', '=', 'casillas.id')
            ->join('pisos', 'casillas.id_piso', '=', 'pisos.id')
            ->join('estantes', 'pisos.id_estante', '=', 'estantes.id')
            ->join('almacens', 'estantes.id_almacen', '=', 'almacens.id')
            ->join('clientes', 'cargas.id_cliente', '=', 'clientes.id')
            ->select(
                'cargas.id',
                'cargas.nombre',
                'cargas.codigo',
                'cargas.fechaexp',
                'tipo_productos.tipo as tipo_producto',
                'tipo_empaquetados.tipo as empaquetado',
                'companias.nombre as compania',
                'almacens.nombre as almacen',
                'estantes.id as estante',
                'pisos.id as piso',
                'cargas.id_casilla',
                'clientes.nombre as cliente',
                'cargas.condrefrig',
                'cargas.peso'
            )
            ->get();

        return view('carga.index', compact('cargas'));
    }

    public function imprimir($id)
    {
        $carga = Carga::find($id);
        $view = View::make('carga.pdf', compact('carga'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download($carga->nombre . ".pdf");
    }


    public function edit($id)
    {
        $carga = Carga::findOrFail($id);
        $tipos_productos = TipoProducto::select('id', 'tipo')->get();
        $tipos_empaquetado = TipoEmpaquetado::select('id', 'tipo')->get();
        $clientes = Cliente::select('id', 'nombre')->get();
        $companias = Compania::select('id', 'nombre')->get();
        $casillas = Casilla::select('id')->get();

        return view('carga.edit', compact('carga', 'tipos_productos', 'tipos_empaquetado', 'clientes', 'companias', 'casillas'));
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
            'condrefrig' => 'required',
            'peso' => 'required'
        ]);
        $cliente = $request->cliente;
        // dd($cliente);
        $empresas = Empresa::select('id', 'nombre')->get();
        return view('factura.create', compact('data', 'empresas', 'cliente'));
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
        $carga = Carga::find($codCarga);
        $casilla = Casilla::find($carga->id_casilla);
        $casilla->ocupada = false;
        $casilla->save();
        $factura = Factura::where('id_cliente', $carga->id_cliente)->first();
        $factura->archivado = true;
        $factura->save();
        $carga->delete();

        return redirect()->route('carga.index')->with('success', 'Carga eliminada correctamente');
    }
}
