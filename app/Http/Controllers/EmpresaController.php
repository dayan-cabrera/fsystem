<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresa = Empresa::first();

        return view('empresa.index', compact('empresa'));
    }

    public function imprimir($id)
    {
        $empresa = Empresa::find($id);
        $view = View::make('empresa.pdf', compact('empresa'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download($empresa->nombre . ".pdf");
    }

    public function edit()
    {
        $empresa = Empresa::first();

        return view('empresa.edit', compact('empresa'));
    }

    public function update(Request $request)
    {

        try {

            $empresa = Empresa::first();

            $data = $request->validate([
                'nombre' => 'required',
                'direccion' => 'required',
                'telefono' => 'required',
                'director' => 'required',
                'recursos_humanos' => 'required',
                'contabilidad' => 'required',
                'secretario' => 'required',
                'logo' => 'image|mimes:jpeg,png,jpg'
            ]);

            $path = public_path('images/');
            $files = glob($path . 'empresa*');

            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }

            $imageName = 'empresa.' . $request->logo->extension();
            $request->logo->move(public_path('images'), $imageName);
            $data['logo'] = $imageName;

            $empresa->update($data);

            return redirect()->route('empresa.index')->with('success', 'ok');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
