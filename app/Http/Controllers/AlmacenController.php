<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Carga;
use App\Models\Casilla;
use App\Models\Empresa;
use App\Models\Estante;
use App\Models\Piso;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Card;

class AlmacenController extends Controller
{

    public function index()
    {
        // getAlmacenes

        $almacenes = DB::table('almacens')->join('empresas', 'almacens.id_empresa', '=', 'empresas.id')
            ->select('almacens.id', 'almacens.nombre', 'empresas.nombre as empresa', 'almacens.condrefrigerado', 'almacens.mantorep', 'almacens.fecha_mant')->orderBy('nombre', 'asc')
            ->where('almacens.mantorep', false)
            ->get();

        return view('almacen.index', compact('almacenes'));
    }
    public function imprimir($id)
    {
        $almacen = Almacen::find($id);
        $view = View::make('almacen.pdf', compact('almacen'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download($almacen->nombre . ".pdf");
    }

    public function create()
    {
        $empresas = Empresa::select('id', 'nombre')->get();
        return view('almacen.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_empresa' => 'required',
                'condrefrigerado' => 'required',
                'nombre' => 'required',
                'fecha_mant' => 'required'
            ]);

            Almacen::create($data);

            return redirect()->route('almacen.index')->with('success', 'creado');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $empresas = Empresa::select('id', 'nombre')->get();
        $almacen = Almacen::findOrFail($id);
        return view('almacen.edit', compact('empresas', 'almacen'));
    }

    public function update(Request $request, $id)
    {
        try {

            $data = $request->validate([
                'id_empresa' => 'required',
                'condrefrigerado' => 'required',
                'nombre' => 'required',
            ]);

            $almacen = Almacen::findOrFail($id);
            $almacen->update($data);

            return redirect()->route('almacen.index')->with('success', 'updated');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Almacen::destroy($id);

        return redirect()->back()->with('success', 'Almacen deleted successfully');
    }

    public function ponerEnMantenimiento($id)
    {
        $listaOcupadas = [];
        // Obtener almacén por id
        $almacen = Almacen::where('id', $id)->first();

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
                    }
                }
            }
        }

        // Reubicación de cargas
        foreach ($listaOcupadas as $casillaOcupada) {
            $carga = Carga::where('id_casilla', $casillaOcupada->id)->first();

            // Buscar un nuevo almacén adecuado para la carga
            $nuevoAlmacen = Almacen::where('mantorep', false)
                ->where('condrefrigerado', $carga->condrefrig)
                ->where('id', '!=', $id)
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

        $almacen->mantorep = true;
        $almacen->save();
        DB::table('estantes')->where('id_almacen', $almacen->id)
            ->update(['mant' => true]);

        foreach ($estantes as $estante) {
            DB::table('pisos')->where('id_estante', $estante->id)
                ->update(['mant' => true]);

            $pisos = DB::table('pisos')->where('id_estante', $estante->id)->get();

            foreach ($pisos as $piso) {
                DB::table('casillas')->where('id_piso', $piso->id)
                    ->update(['mant' => true, 'ocupada' => false]);
            }
        }

        return back()->with('success', 'ok');
    }

    public function mantEdit($id)
    {
        $almacen = Almacen::findOrFail($id);
        return view('almacen.mant', compact('almacen'));
    }

    public function quitarDeMantenimiento(Request $request, $id)
    {
        try {
            $request->validate([
                'fecha_mant' => 'required|date|after_or_equal:' . date('Y-m-d')
            ]);

            // Obtener almacén por código
            $almacen = Almacen::findOrFail($id);
            if ($almacen && $almacen->mantorep) {
                // Quitar almacén de mantenimiento
                $almacen->fecha_mant = $request->fecha_mant;
                $almacen->mantorep = false;
                $almacen->save();

                DB::table('estantes')->where('id_almacen', $almacen->id)
                    ->update(['mant' => false]);

                $estantes = DB::table('estantes')->where('id_almacen', $almacen->id)->get();

                foreach ($estantes as $estante) {
                    DB::table('pisos')->where('id_estante', $estante->id)
                        ->update(['mant' => false]);

                    $pisos = DB::table('pisos')->where('id_estante', $estante->id)->get();

                    foreach ($pisos as $piso) {
                        DB::table('casillas')->where('id_piso', $piso->id)
                            ->update(['mant' => false]);
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
