<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        // getFacturas

        $facturas = Factura::all();
        return view('factura.index', compact('facturas'));
    }

    public function create() {
        return view('factura.create');
    }

    public function store(Request $request)
    {
        // insertarFactura
        
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
            'archivado' => 'required',
        ]);
    
        Factura::create($data);
        return redirect()->route('factura.index');
    }

    public function edit($id) {
        $factura = Factura::findOrFail($id);

        return view('factura.edit', compact('factura'));
    }

    public function update(Request $request, $id)
    {
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
            'archivado' => 'required',
        ]);

        $factura = Factura::findOrFail($id);
        $factura->update($data);
        return redirect()->route('factura.index');
    }

    public function destroy($id)
    {
        Factura::destroy($id);
        return redirect()->route('factura.index');
    }
}
