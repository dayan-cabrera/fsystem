<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Carga;
use App\Models\Casilla;
use App\Models\Estante;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CasillaController extends Controller
{

    public function index($id_piso)
    {
        // getEstantes
        $casillas = DB::table('casillas')->join('pisos', 'casillas.id_piso', '=', 'pisos.id')
            ->where('casillas.mant', false)->where('id_piso', $id_piso)
            ->select('casillas.id', 'pisos.id as piso', 'casillas.mant', 'casillas.fecha_mant', 'casillas.ocupada')
            ->get();


        return view('casilla.index', compact('casillas', 'id_piso'));
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

        $casilla = Casilla::findOrFail($id);

        // Obtener Pisos del almacén
        $piso = Piso::findOrFail($casilla->id_piso);
        $estante = Estante::findOrFail($piso->id_estante);

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
                ->where('id', '!=', $estante->id_almacen)
                ->first();
            if (!$nuevoAlmacen) return back()->with('error', 'No hay almacen disponible para las características de las cargas');

            // Reubicar carga
            $nuevaCasilla = DB::table('casillas')->join('pisos', 'casillas.id_piso', '=', 'pisos.id')
                ->join('estantes', 'pisos.id_estante', '=', 'estantes.id')->where('estantes.id_almacen', $nuevoAlmacen->id)
                ->where('casillas.ocupada', false)->select('casillas.id')->first();

            if (!$nuevaCasilla) return back()->with('error', 'No hay casillas disponible para las características de las cargas');

            $carga->id_casilla = $nuevaCasilla->id;
            $carga->save();
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

                return redirect()->route('mant.index')->with('success', 'El almacén ha sido quitado de mantenimiento y las cargas han sido reubicadas.');
            }

            return back()->with('error', 'El almacén no está en mantenimiento o no se encontró.');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
