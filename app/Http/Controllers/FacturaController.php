<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::all();
        return view('facturas.index', compact('facturas'));
    }

    public function store(Request $request)
    {
        $factura = Factura::create($request->all());
        return redirect()->route('facturas.index');
    }

    public function update(Request $request, $id)
    {
        $factura = Factura::find($id);
        $factura->update($request->all());
        return redirect()->route('facturas.index');
    }

    public function destroy($id)
    {
        Factura::destroy($id);
        return redirect()->route('facturas.index');
    }
}
