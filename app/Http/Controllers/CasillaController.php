<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Carga;
use App\Models\Casilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CasillaController extends Controller
{
    private $cargas = [];

    public function index($id_piso)
    {
        // getEstantes
        $casillas = DB::table('casillas')->join('pisos', 'casillas.id_piso', '=', 'pisos.id')
            ->where('casillas.mant', false)->where('id_piso', $id_piso)
            ->select('casillas.id', 'pisos.id as piso', 'casillas.mant', 'casillas.fecha_mant')
            ->get();


        return view('casilla.index', compact('casillas', 'id_piso'));
    }

    public function cargas($id_cas)
    {
        $cargas = DB::table('cargas')->where('id_casilla', $id_cas)
            ->join('tipo_productos', 'cargas.id_tipoprod', '=', 'tipo_productos.id')
            ->join('tipo_empaquetados', 'cargas.id_empaquetado', '=', 'tipo_empaquetados.id')
            ->join('companias', 'cargas.id_compania', '=', 'companias.id')
            ->join('casillas', 'cargas.id_casilla', '=', 'casillas.id')
            ->join('clientes', 'cargas.id_cliente', '=', 'clientes.id')
            ->select('cargas.id', 'cargas.nombre', 'cargas.codigo', 'cargas.fechaexp', 'tipo_productos.tipo as tipo_producto', 'tipo_empaquetados.tipo as empaquetado', 'companias.nombre as compania', 'id_casilla', 'clientes.nombre as cliente', 'cargas.condrefrig', 'cargas.peso')
            ->get();

        return view('casilla.cargas', compact('cargas'));
    }

    public function create($id_piso)
    {
        return view('casilla.create', compact('id_piso'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_piso' => 'required',
                'fecha_mant' => 'required|date|after_or_equal:' . date('Y-m-d')
            ]);

            Casilla::create($data);

            return redirect()->route('casilla.index', $data['id_piso'])->with('success', 'creado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Casilla::destroy($id);

        return redirect()->back()->with('success', 'Estante deleted successfully');
    }

    public function ponerEnMantenimiento($id)
    {
        $listaOcupadas = [];

        // Obtener Pisos del almacén

        $casilla = Casilla::findOrFail($id);
        if ($casilla->ocupada) {
            // Añadir a lista de ocupadas
            $listaOcupadas[] = $casilla;
        }

        // Reubicación de cargas
        foreach ($listaOcupadas as $casillaOcupada) {
            $carga = Carga::where('id_casilla', $casillaOcupada->id)->first();

            // Buscar un nuevo almacén adecuado para la carga
            $nuevoAlmacen = Almacen::where('mantorep', false)
                ->where('condrefrigerado', $carga->condrefrig)
                ->first();
            if (!$nuevoAlmacen) return back()->with('error', 'No hay almacen disponible para las características de las cargas');

            // Reubicar carga
            $nuevaCasilla = Casilla::where('id_piso', $nuevoAlmacen->id)
                ->where('mant', false)
                ->first();
            if (!$nuevaCasilla) return back()->with('error', 'No hay casillas disponible para las características de las cargas');

            $carga->id_casilla = $nuevaCasilla->id;
            $carga->save();
            $this->cargas = $carga->id;
            $casilla->update(['ocupada' => true]);
        }

        $casilla->mant = true;
        $casilla->ocupada = false;
        $casilla->save();

        return back()->with('success', 'ok');
    }

    public function mantEdit($id)
    {
        $casilla = Casilla::findOrFail($id);
        return view('casilla.mant', compact('casilla'));
    }

    public function quitarDeMantenimiento(Request $request, $id)
    {
        try {
            $request->validate([
                'fecha_mant' => 'required|date|after_or_equal:' . date('Y-m-d')
            ]);

            // Obtener piso por id
            $casilla = Casilla::findOrFail($id);

            if ($casilla) {
                // Quitar piso de mantenimiento
                $casilla->fecha_mant = $request->fecha_mant;
                $casilla->mant = false;
                $casilla->save();

                foreach ($this->cargas as $carga) {
                    $reubicar_carga = Carga::find($carga->id);
                    if ($reubicar_carga) {
                        $reubicar_carga->id_casilla = $carga->id_casilla;
                        $casilla = Casilla::find($carga->id_casilla);
                        if ($casilla) {
                            $casilla->ocupada = true;
                            $casilla->save();
                        }
                    }
                }

                return redirect()->route('mant.index')->with('success', 'El almacén ha sido quitado de mantenimiento y las cargas han sido reubicadas.');
            }

            return back()->with('error', 'El almacén no está en mantenimiento o no se encontró.');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}