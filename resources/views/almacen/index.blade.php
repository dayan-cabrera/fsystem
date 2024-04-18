<x-layout>
    <div class="text-center p-4 add">
        <h1>Gestión de almacens</h1>
        <form action="{{route('almacen.create')}}" method="get">
            <button type="submit" class="btn btn-success" style="width: 50%;">Agregar</button>
        </form>
    </div>
    @if (count($almacenes) == 0)
    <p>almacens sin registrar</p>
    @else
    <div class="container table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">ID Empresa</th>
                    <th scope="col">Refrigerado</th>
                    <th scope="col">Mant. Rep.</th>
                    <th scope="col">Fecha Mantenimiento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @inject('carbon', 'Carbon\Carbon')
                @foreach ($almacenes as $almacen)
                @php
                $fechaMant = $carbon::parse($almacen->fecha_mant);
                $hoy = $carbon::today();
                $mant = $fechaMant->lt($hoy) ? true : false;
                @endphp

                <tr class="{{ $fechaMant->lt($hoy) ? 'text-danger' : '' }}">
                    <td class="align-middle" scope="row">{{$loop->index+1}}</td>
                    <td class="align-middle">{{$almacen->nombre}}</td>
                    <td class="align-middle">{{$almacen->empresa}}</td>
                    <td class="align-middle">{{($almacen->condrefrigerado == 1) ? "Sí" : "No" }}</td>
                    <td class="align-middle">{{($almacen->mantorep == 1) ? "Sí" : "No" }}</td>
                    <td class="align-middle">{{$almacen->fecha_mant}}</td>
                    <td id="btns" class="align-middle" style="padding: 1rem;">
                        <div class="d-flex">
                            <form action="{{route('almacen.edit', $almacen->id)}}" method="get">
                                @csrf
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Editar</button>
                            </form>
                            <form action="{{route('almacen.p_mant', $almacen->id)}}" method="post">
                                @csrf
                                @method('patch')
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Mantenimiento</button>
                            </form>
                            <form action="{{route('almacen.destroy', $almacen->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" style="margin: 4px;" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if ($mant)
                <x-alert.info>
                    <p>Tiene almacences pasados del tiempo de mantenimiento</p>
                </x-alert.info>
                @endif
            </tbody>
        </table>
        @endif
    </div>
</x-layout>