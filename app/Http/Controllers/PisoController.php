<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Carga;
use App\Models\Casilla;
use App\Models\Piso;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PisoController extends Controller
{
    private $cargas = [];

    public function index($id_est)
    {
        // getEstantes
        $pisos = DB::table('pisos')->join('estantes', 'pisos.id_estante', '=', 'estantes.id')
            ->where('pisos.mant', false)->where('id_estante', $id_est)
            ->select('pisos.id', 'estantes.id as estante', 'pisos.mant', 'pisos.fecha_mant')
            ->get();


        return view('piso.index', compact('pisos', 'id_est'));
    }

    public function create($id_est)
    {
        return view('piso.create', compact('id_est'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_estante' => 'required',
                'fecha_mant' => 'required|date|after_or_equal:' . date('Y-m-d')
            ]);

            Piso::create($data);

            return redirect()->route('piso.index', $data['id_estante'])->with('success', 'creado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Piso::destroy($id);

        return redirect()->back()->with('success', 'Estante deleted successfully');
    }

    public function ponerEnMantenimiento($id)
    {
        $listaOcupadas = [];

        // Obtener Pisos del almacén
        $piso = Piso::findOrFail($id);

        $casillas = Casilla::where('id_piso', $piso->id)->get();
        foreach ($casillas as $casilla) {
            if ($casilla->ocupada) {
                // Añadir a lista de ocupadas
                $listaOcupadas[] = $casilla;
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

        $piso->mant = true;
        $piso->save();

        DB::table('casillas')->where('id_piso', $piso->id)->update(['mant' => true, 'ocupada' => false]);

        return back()->with('success', 'ok');
    }

    public function mantEdit($id)
    {
        $piso = Piso::findOrFail($id);
        return view('piso.mant', compact('piso'));
    }

    public function quitarDeMantenimiento(Request $request, $id)
    {
        try {
            $request->validate([
                'fecha_mant' => 'required|date|after_or_equal:' . date('Y-m-d')
            ]);

            // Obtener piso por id
            $piso = Piso::findOrFail($id);

            if ($piso) {
                // Quitar piso de mantenimiento
                $piso->fecha_mant = $request->fecha_mant;
                $piso->mant = false;
                $piso->save();

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

                DB::table('casillas')->where('id_piso', $piso->id)
                    ->update(['mant' => false]);

                return redirect()->route('mant.index')->with('success', 'El almacén ha sido quitado de mantenimiento y las cargas han sido reubicadas.');
            }

            return back()->with('error', 'El almacén no está en mantenimiento o no se encontró.');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
