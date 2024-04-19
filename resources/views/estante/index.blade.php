<x-layout>
    <div class="text-center p-4 add">
        <h1>Gestión de estantes</h1>
        <form action="{{route('estante.create', $id_alm)}}" method="get">
            <button type="submit" class="btn btn-success" style="width: 50%;">Agregar</button>
        </form>
    </div>
    @if (count($estantes) == 0)
    <p>estantes sin registrar</p>
    @else
    <div class="container table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Código</th>
                    <th scope="col">Almacen</th>
                    <th scope="col">Mantenimineto</th>
                    <th scope="col">Fecha Mantenimiento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @inject('carbon', 'Carbon\Carbon')
                @foreach ($estantes as $estante)
                @php
                $fechaMant = $carbon::parse($estante->fecha_mant);
                $hoy = $carbon::today();
                $mant = $fechaMant->lt($hoy) ? true : false;
                @endphp

                <tr class="{{ $fechaMant->lt($hoy) ? 'text-danger' : '' }}">
                    <td class="align-middle" scope="row">{{$loop->index+1}}</td>
                    <td class="align-middle">{{$estante->id}}</td>
                    <td class="align-middle">{{$estante->almacen}}</td>
                    <td class="align-middle">{{($estante->mant == 1) ? "Sí" : "No" }}</td>
                    <td class="align-middle">{{$estante->fecha_mant}}</td>
                    <td id="btns" class="align-middle" style="padding: 1rem;">
                        <div class="d-flex">
                            <form action="" method="get">
                                @csrf
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Pisos</button>
                            </form>
                            <form action="{{route('estante.p_mant', $estante->id)}}" method="post">
                                @csrf
                                @method('patch')
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Mantenimiento</button>
                            </form>
                            <form action="{{route('estante.destroy', $estante->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" style="margin: 4px;" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                <!-- @if ($mant)
                <x-alert.info>
                    <p>Tiene estanteces pasados del tiempo de mantenimiento</p>
                </x-alert.info>
                @endif -->
            </tbody>
        </table>
    </div>
    @endif
</x-layout>