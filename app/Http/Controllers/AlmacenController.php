<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Empresa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenController extends Controller
{
    public function index()
    {
        // getAlmacenes

        $almacenes = DB::table('almacens')->join('empresas', 'almacens.id_empresa', '=', 'empresas.id')
        ->select('almacens.id','almacens.nombre', 'empresas.nombre as empresa', 'almacens.condrefrigerado', 'almacens.mantorep', 'almacens.fecha_mant')->orderBy('nombre', 'asc')->get();
        

        return view('almacen.index', compact('almacenes'));

    }

    public function create() {
        $empresas = Empresa::select('id', 'nombre')->get();
        return view('almacen.create', compact('empresas'));
    }

    public function store(Request $request) {
            
        $data = $request->validate([
            'id_empresa' => 'required',
            'condrefrigerado' => 'required',
            'nombre' => 'required',
            'mantorep' => 'required',
            'fecha_mant' => 'required'
        ]);
        
        Almacen::create($data);
        
        return redirect()->route('almacen.index')->with('success', 'creado');
    }

    public function edit($id) {
        $empresas = Empresa::select('id', 'nombre')->get();
        $almacen = Almacen::findOrFail($id);
        return view('almacen.edit', compact('empresas', 'almacen'));
    }
    

    public function update(Request $request, $id) {
        $data = $request->validate([
            'id_empresa' => 'required',
            'condrefrigerado' => 'required',
            'nombre' => 'required',
            'mantorep' => 'required',
            'fecha_mant' => 'required'
        ]);
    
        $almacen = Almacen::findOrFail($id);
        $almacen->update($data);
    
        return redirect()->route('almacen.index')->with('success', 'updated');

    }

    public function destroy($id) {
        Almacen::destroy($id);
        
        return redirect()->back()->with('success', 'Almacen deleted successfully');
    }
    
}
