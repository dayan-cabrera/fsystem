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

class EstanteController extends Controller
{
    private $cargas = [];

    public function index($id_alm)
    {
        // getEstantes

        $estantes = DB::table('estantes')->join('almacens', 'estantes.id_almacen', '=', 'almacens.id')
            ->select('estantes.id', 'almacens.nombre as almacen', 'estantes.mant', 'estantes.fecha_mant')
            ->where('id_almacen', $id_alm)->where('mant', false)
            ->get();

        return view('estante.index', compact('estantes', 'id_alm'));
    }

    public function create($id_alm)
    {
        return view('estante.create', compact('id_alm'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_almacen' => 'required',
                'fecha_mant' => 'required|date|after_or_equal:' . date('Y-m-d')
            ]);

            Estante::create($data);

            return redirect()->route('estante.index', $data['id_almacen'])->with('success', 'creado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Estante::destroy($id);

        return redirect()->back()->with('success', 'Estante deleted successfully');
    }

    public function ponerEnMantenimiento($id)
    {
        $listaOcupadas = [];
        // Obtener estante por id
        $estante = Estante::where('id', $id)->first();

        // Obtener Pisos del almacén
        $pisos = Piso::where('id_estante', $id)->get();
        foreach ($pisos as $piso) {
            $casillas = Casilla::where('id_piso', $piso->id)->get();
            foreach ($casillas as $casilla) {
                if ($casilla->ocupada) {
                    // Añadir a lista de ocupadas
                    $listaOcupadas[] = $casilla;
                }
            }
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

        $estante->mant = true;
        $estante->save();
        DB::table('pisos')->where('id_estante', $estante->id)
            ->update(['mant' => true]);

        foreach ($pisos as $piso) {
            DB::table('casillas')->where('id_piso', $piso->id)
                ->update(['mant' => true, 'ocupada' => false]);
        }

        return back()->with('success', 'ok');
    }

    public function mantEdit($id)
    {
        $estante = Estante::findOrFail($id);
        return view('estante.mant', compact('estante'));
    }

    public function quitarDeMantenimiento(Request $request, $id)
    {
        try {
            $request->validate([
                'fecha_mant' => 'required|date|after_or_equal:' . date('Y-m-d')
            ]);

            // Obtener estante por id
            $estante = Estante::findOrFail($id);

            if ($estante) {
                // Quitar estante de mantenimiento
                $estante->fecha_mant = $request->fecha_mant;
                $estante->mant = false;
                $estante->save();

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

                DB::table('pisos')->where('id_estante', $estante->id)
                    ->update(['mant' => false]);
                $pisos = Piso::where('id_estante', $estante->id)->get();

                foreach ($pisos as $piso) {
                    DB::table('casillas')->where('id_piso', $piso->id)
                        ->update(['mant' => false]);
                }

                return redirect()->route('mant.index')->with('success', 'El almacén ha sido quitado de mantenimiento y las cargas han sido reubicadas.');
            }

            return back()->with('error', 'El almacén no está en mantenimiento o no se encontró.');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
