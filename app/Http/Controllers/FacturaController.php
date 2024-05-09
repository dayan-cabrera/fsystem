<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Casilla;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

use function Laravel\Prompts\select;

class FacturaController extends Controller
{
    public function index()
    {
        // getFacturas

        $facturas = DB::table('facturas')->join('clientes', 'facturas.id_cliente', '=', 'clientes.id')
            ->select('facturas.id', 'facturas.archivado', 'clientes.nombre as cliente', 'facturas.tarifa_tr', 'facturas.tarifa_peso', 'facturas.tarifa_tiempo', 'facturas.tarifa_refr', 'facturas.tarifa_af', 'facturas.fecha_acordada', 'facturas.fecha_entrada', 'facturas.fecha_salida')
            ->orderBy('facturas.archivado', 'desc')->get();
        return view('factura.index', compact('facturas'));
    }

    public function create($carga)
    {

        return view('factura.create', compact('carga', 'empresas'));
    }

    public function imprimir($id)
    {
        $factura = DB::table('facturas')
            ->join('clientes', 'facturas.id_cliente', '=', 'clientes.id')
            ->where('facturas.id', $id)
            ->select(
                'facturas.tarifa_tr',
                'facturas.tarifa_peso',
                'facturas.tarifa_tiempo',
                'facturas.tarifa_refr',
                'facturas.tarifa_af',
                'facturas.fecha_acordada',
                'facturas.fecha_entrada',
                'facturas.fecha_salida',
                'clientes.nombre as cliente'
            )->first();
        $view = View::make('factura.pdf', compact('factura'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download("pdfview.pdf");
    }

    public function store(Request $request)
    {
        // insertarFactura
        // dd($request->carga);
        $data = $request->validate([
            'id_empresa' => 'required',
            'tarifa_tr' => 'required',
            'id_cliente' => 'required',
            'fecha_acordada' => 'required',
            'fecha_entrada' => 'required',
            'fecha_salida' => 'required',
        ]);

        $carga = $request->validate([
            'carga' => 'required',
        ]);
        // creacion del cliente correspondiente a la carga
        $cliente = new Cliente();
        $cliente->nombre = $request->id_cliente[0];
        $cliente->pais = $request->id_cliente[1];
        $cliente->telefono = $request->id_cliente[2];
        $cliente->fax = $request->id_cliente[3];
        $cliente->email = $request->id_cliente[4];
        $cliente->anos = $request->id_cliente[5];
        $cliente->prioridad = $request->id_cliente[6];
        $cliente->entidad = $request->id_cliente[7];
        $cliente->save();
        $data['id_cliente'] = $cliente->id;
        // Creacion de la carga correspondiente a la factura
        $carga = new Carga();
        $carga->nombre = $request->carga[0];
        $carga->codigo = $request->carga[1];
        $carga->fechaexp = $request->carga[2];
        $carga->id_tipoprod = $request->carga[3];
        $carga->id_empaquetado = $request->carga[4];
        $carga->id_compania = $request->carga[5];
        $carga->id_casilla = $request->carga[6];
        $carga->id_cliente = $cliente->id;
        $carga->condrefrig = $request->carga[7];
        $carga->peso = $request->carga[8];
        $carga->save();
        $casilla = Casilla::find($carga->id_casilla);
        $casilla->ocupada = true;
        $casilla->save();


        // Suponiendo que 'fecha_entrada' y 'fecha_salida' son fechas en formato 'Y-m-d'
        $fechaEntrada = Carbon::createFromFormat('Y-m-d', $request->input('fecha_entrada'));
        $fechaSalida = Carbon::createFromFormat('Y-m-d', $request->input('fecha_salida'));

        // Calcular la diferencia en días
        $cantidadDias = $fechaEntrada->diffInDays($fechaSalida);
        $tarifa_peso = 0.9 * $carga->peso;
        $tarifa_tiempo = 0.9 * $cantidadDias;
        $tarifa_refr = ($carga->condrefrig == 1) ? 20 : 0;
        $tarifa_af = 40;

        $factura = new Factura();
        $factura->id_empresa = $data['id_empresa'];
        $factura->id_cliente = $data['id_cliente'];
        $factura->tarifa_tr = $data['tarifa_tr'];
        $factura->tarifa_peso = $tarifa_peso;
        $factura->tarifa_tiempo = $tarifa_tiempo;
        $factura->tarifa_refr = $tarifa_refr;
        $factura->tarifa_af = $tarifa_af;
        $factura->fecha_acordada = $data['fecha_acordada'];
        $factura->fecha_entrada = $data['fecha_entrada'];
        $factura->fecha_salida = $data['fecha_salida'];
        $factura->save();

        return redirect()->route('cliente.index')->with('success', 'ok');
    }


    public function update(Request $request, $id)
    {
        $factura = Factura::findOrFail($id);
        $factura->archivado = !$factura->archivado;
        $factura->save();

        return redirect()->route('factura.index')->with('success', 'ok');
    }

    public function destroy($id)
    {
        Factura::destroy($id);
        return redirect()->route('factura.index')->with('success', 'ok');
    }
}
