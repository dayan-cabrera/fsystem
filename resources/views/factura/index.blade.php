<x-layout>
    <div class="text-center p-4 add">
        <h1>Gestión de facturaes</h1>
    </div>
    @if (count($facturas) == 0)
    <p>facturas sin registrar</p>
    @else
    <div class="container table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Tarifa TR</th>
                    <th scope="col">Tarifa Peso</th>
                    <th scope="col">Tarifa Tiempo</th>
                    <th scope="col">Tarifa Refrig.</th>
                    <th scope="col">Tarifa AF</th>
                    <th scope="col">Fecha Acordada</th>
                    <th scope="col">Fecha Entrada</th>
                    <th scope="col">Fecha Salida</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                <tr >
                    <!-- Mostrar datos de $facturas -->
                    <td class="align-middle">{{ $loop->index+1 }}</td>
                    <td class="align-middle">{{ $factura->cliente }}</td>
                    <td class="align-middle">{{ $factura->tarifa_tr }}</td>
                    <td class="align-middle">{{ $factura->tarifa_peso }}</td>
                    <td class="align-middle">{{ $factura->tarifa_tiempo }}</td>
                    <td class="align-middle">{{ $factura->tarifa_refr }}</td>
                    <td class="align-middle">{{ $factura->tarifa_af }}</td>
                    <td class="align-middle">{{ $factura->fecha_acordada }}</td>
                    <td class="align-middle">{{ $factura->fecha_entrada }}</td>
                    <td class="align-middle">{{ $factura->fecha_salida }}</td>
                    <td class="align-middle">
                        <form action="{{route('factura.update', $factura->id)}}" method="post">
                            @csrf
                            @method('patch')
                            <button type="submit" style="margin: 4px;" class="btn btn-sm btn-info">{{($factura->archivado == 1) ? 'Archibar' : 'Desarchibar'}}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</x-layout>
