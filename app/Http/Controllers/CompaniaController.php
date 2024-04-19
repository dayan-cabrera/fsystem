<?php

namespace App\Http\Controllers;

use App\Models\Compania;
use App\Models\CondAlm;
use App\Models\Empresa;
use App\Models\Prioridad;
use App\Models\Seguridad;
use App\Models\TipoCompania;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CompaniaController extends Controller
{
    public function index()
    {
        $companias = DB::table('companias')
            ->join('tipo_companias', 'companias.id_tipocomp', '=', 'tipo_companias.id')
            ->join('seguridads', 'companias.id_seguridad', '=', 'seguridads.id')
            ->join('cond_alms', 'companias.id_condalm', '=', 'cond_alms.id')
            ->join('prioridads', 'companias.id_prioridad', '=', 'prioridads.id')
            ->join('empresas', 'companias.id_empresa', '=', 'empresas.id')
            ->select(
                'companias.id',
                'tipo_companias.tipo as compania',
                'seguridads.nombre as seguridad',
                'cond_alms.nombre as cond_alm',
                'prioridads.prioridad as prioridad',
                'empresas.nombre as empresa',
                'companias.nombre as nombre'
            )->orderBy('companias.nombre', 'asc')->get();

        return view('compania.index', compact('companias'));
    }

    // public function show($id)
    // {
    //     // selectComp
    //     $compania = Compania::findOrFail($id);
    //     return view('compania.select', compact('compania'));
    // }

    public function create()
    {
        $tipos = TipoCompania::select('id', 'tipo')->get();
        $condalms = CondAlm::select('id', 'nombre')->get();
        $seguridades = Seguridad::select('id', 'nombre')->get();
        $prioridades = Prioridad::select('id', 'prioridad')->get();
        $empresas = Empresa::select('id', 'nombre')->get();


        return view('compania.create', compact('tipos', 'condalms', 'seguridades', 'prioridades', 'empresas'));
    }

    public function store(Request $request)
    {
        try {

            $data = $request->validate([
                'id_tipocomp' => 'required',
                'id_seguridad' => 'required',
                'id_condalm' => 'required',
                'id_prioridad' => 'required',
                'id_empresa' => 'required',
                'nombre' => 'required'
            ]);

            Compania::create($data);

            return redirect()->route('compania.index')->with('success', 'ok');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $compania = Compania::findOrFail($id);
        $tipos = TipoCompania::select('id', 'tipo')->get();
        $condalms = CondAlm::select('id', 'nombre')->get();
        $seguridades = Seguridad::select('id', 'nombre')->get();
        $prioridades = Prioridad::select('id', 'prioridad')->get();
        $empresas = Empresa::select('id', 'nombre')->get();

        return view('compania.edit', compact('compania', 'tipos', 'condalms', 'seguridades', 'prioridades', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        try {
            $compania = Compania::findOrFail($id);

            $data = $request->validate([
                'id_tipocomp' => 'required',
                'id_seguridad' => 'required',
                'id_condalm' => 'required',
                'id_prioridad' => 'required',
                'id_empresa' => 'required',
                'nombre' => 'required'
            ]);

            $compania->update($data);

            return redirect()->route('compania.index')->with('success', 'ok');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Compania::destroy($id);
        return redirect()->back()->with('success', 'ok');
    }

    // public function getTipoC()
    // {
    //     $tipos = Auxi::where('tipo', 'tipo_compania')->get();
    //     return view('companias.tipo', compact('tipos'));
    // }

    // public function getCondA()
    // {
    //     $condiciones = Auxi::where('tipo', 'cond_alm')->get();
    //     return view('companias.cond', compact('condiciones'));
    // }

    // public function getSeg()
    // {
    //     $seguridades = Auxi::where('tipo', 'seguridad')->get();
    //     return view('companias.seg', compact('seguridades'));
    // }

    // public function getPrior()
    // {
    //     $prioridades = Auxi::where('tipo', 'prioridad')->get();
    //     return view('companias.prior', compact('prioridades'));
    // }
}
