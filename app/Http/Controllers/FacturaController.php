<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Empresa;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function index()
    {
        // getFacturas

        $facturas = DB::table('facturas')->join('clientes', 'facturas.id_cliente', '=', 'clientes.id')
            ->select('facturas.id', 'facturas.archivado', 'clientes.nombre as cliente', 'facturas.tarifa_tr', 'facturas.tarifa_peso', 'facturas.tarifa_tiempo', 'facturas.tarifa_refr', 'facturas.tarifa_af', 'facturas.fecha_acordada', 'facturas.fecha_entrada', 'facturas.fecha_salida')
            ->orderBy('facturas.archivado', 'desc')->get();
        return view('factura.index', compact('facturas'));
    }

    public function create($carga)
    {

        return view('factura.create', compact('carga', 'empresas'));
    }

    public function store(Request $request)
    {
        // insertarFactura
        // dd($request->carga);
        $data = $request->validate([
            'id_empresa' => 'required',
            'id_cliente' => 'required',
            'tarifa_tr' => 'required',
            'tarifa_peso' => 'required',
            'tarifa_tiempo' => 'required',
            'tarifa_refr' => 'required',
            'tarifa_af' => 'required',
            'fecha_acordada' => 'required',
            'fecha_entrada' => 'required',
            'fecha_salida' => 'required',
        ]);
        $carga = $request->validate([
            'carga' => 'required',
        ]);

        $carga = new Carga();
        $carga->nombre = $request->carga[0];
        $carga->codigo = $request->carga[1];
        $carga->fechaexp = $request->carga[2];
        $carga->id_tipoprod = $request->carga[3];
        $carga->id_empaquetado = $request->carga[4];
        $carga->id_compania = $request->carga[5];
        $carga->id_casilla = $request->carga[6];
        $carga->id_cliente = $request->carga[7];
        $carga->condrefrig = $request->carga[8];
        $carga->peso = $request->carga[9];
        $carga->save();
        Factura::create($data);
        return redirect()->route('carga.index')->with('success', 'ok');
    }


    public function update(Request $request, $id)
    {
        $factura = Factura::findOrFail($id);
        $factura->archivado = !$factura->archivado;
        $factura->save();

        return redirect()->route('factura.index')->with('success', 'ok');
    }

    public function destroy($id)
    {
        Factura::destroy($id);
        return redirect()->route('factura.index');
    }
}
