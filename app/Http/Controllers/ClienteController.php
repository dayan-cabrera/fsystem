<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Services\Contracts\ClienteServiceInterface;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('cliente.index', compact('clientes'));
    }

    public function create() {
        return view('cliente.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'fax' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'anos' => 'required|string|min:0',
            'prioridad' => 'boolean',
            'entidad' => 'boolean'
        ]);


        Cliente::create($data);
        return redirect()->route('cliente.index');
    }

    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect()->route('cliente.index');
    }
}
