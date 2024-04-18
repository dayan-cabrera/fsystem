<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Carga;
use App\Models\Casilla;
use App\Models\Empresa;
use App\Models\Estante;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenController extends Controller
{
    private $cargas = [];

    public function index()
    {
        // getAlmacenes

        $almacenes = DB::table('almacens')->join('empresas', 'almacens.id_empresa', '=', 'empresas.id')
            ->select('almacens.id', 'almacens.nombre', 'empresas.nombre as empresa', 'almacens.condrefrigerado', 'almacens.mantorep', 'almacens.fecha_mant')->orderBy('nombre', 'asc')
            ->where('almacens.mantorep', false)
            ->get();

        $mantenimiento = DB::table('almacens')->join('empresas', 'almacens.id_empresa', '=', 'empresas.id')
            ->select('almacens.id', 'almacens.nombre', 'empresas.nombre as empresa', 'almacens.condrefrigerado', 'almacens.mantorep', 'almacens.fecha_mant')->orderBy('nombre', 'asc')
            ->where('almacens.mantorep', true)
            ->get();


        return view('almacen.index', compact('almacenes', 'mantenimiento'));
    }

    public function create()
    {
        $empresas = Empresa::select('id', 'nombre')->get();
        return view('almacen.create', compact('empresas'));
    }

    public function store(Request $request)
    {

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

    public function edit($id)
    {
        $empresas = Empresa::select('id', 'nombre')->get();
        $almacen = Almacen::findOrFail($id);
        return view('almacen.edit', compact('empresas', 'almacen'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_empresa' => 'required',
            'condrefrigerado' => 'required',
            'nombre' => 'required',
            'fecha_mant' => 'required'
        ]);

        $almacen = Almacen::findOrFail($id);
        $almacen->update($data);

        return redirect()->route('almacen.index')->with('success', 'updated');
    }

    public function destroy($id)
    {
        Almacen::destroy($id);

        return redirect()->back()->with('success', 'Almacen deleted successfully');
    }

    public function ponerEnMantenimiento($id)
    {
        $listaOcupadas = [];
        // Obtener almacén por código
        $almacen = Almacen::where('id', $id)->first();
        if ($almacen) {
            // Poner almacén en mantenimiento
            $almacen->mantorep = true;
            $almacen->save();
        }

        // Obtener estantes del almacén
        $estantes = Estante::where('id_almacen', $almacen->id)->get();
        foreach ($estantes as $estante) {
            // Procesar pisos y casillas
            $pisos = Piso::where('id_estante', $estante->id)->get();
            foreach ($pisos as $piso) {
                $casillas = Casilla::where('id_piso', $piso->id)->get();
                foreach ($casillas as $casilla) {
                    if ($casilla->ocupada) {
                        // Añadir a lista de ocupadas
                        $listaOcupadas[] = $casilla;

                        // Modificar casilla
                        $casilla->mant = true;
                        $casilla->save();
                    }
                }
            }
        }

        // Reubicación de cargas
        foreach ($listaOcupadas as $casillaOcupada) {
            $carga = Carga::where('id_casilla', $casillaOcupada->id)->first();
            $this->cargas = $carga->id;

            // Buscar un nuevo almacén adecuado para la carga
            $nuevoAlmacen = Almacen::where('mantorep', false)
                ->where('condrefrigerado', $carga->condrefrig)
                ->first();
            if ($nuevoAlmacen) {
                // Reubicar carga
                $nuevaCasilla = Casilla::where('id_piso', $nuevoAlmacen->id)
                    ->where('mant', false)
                    ->first();
                if ($nuevaCasilla) {
                    $carga->id_casilla = $nuevaCasilla->id;
                    $carga->save();

                    // Eliminar de lista de ocupadas
                    // $index = array_search($casillaOcupada, $listaOcupadas);
                    // if ($index !== false) {
                    //     unset($listaOcupadas[$index]);
                    // }
                }
            }
        }

        return back()->with('success', 'ok');

        // Retorno
        // if (empty($listaOcupadas)) {
        //     return back()->with('info', 'Todas las cargas ocupadas pudieron ser reubicadas');
        // }
        // return back()->with('info', 'Las cargas ocupadas no pudieron ser reubicadas');
    }

    public function quitarDeMantenimiento($id)
    {
        // Obtener almacén por código
        $almacen = Almacen::where('id', $id)->first();
        if ($almacen && $almacen->mantorep) {
            // Quitar almacén de mantenimiento
            $almacen->mantorep = false;
            $almacen->save();

            foreach ($this->cargas as $carga) {
                // Buscar una casilla disponible en el nuevo almacén
                $nuevaCasilla = Casilla::where('id_piso', $almacen->id)
                    ->where('mant', false)
                    ->first();

                if ($nuevaCasilla) {
                    // Reubicar carga
                    $carga->id_casilla = $nuevaCasilla->id;
                    $carga->save();
                }
                $nuevaCasilla->mant = true;
            }

            return back()->with('success', 'El almacén ha sido quitado de mantenimiento y las cargas han sido reubicadas.');
        }

        return back()->with('error', 'El almacén no está en mantenimiento o no se encontró.');
    }
}
