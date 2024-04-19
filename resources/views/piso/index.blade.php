<x-layout>
    <div class="text-center p-4 add">
        <h1>Gestión de pisos</h1>
        <form action="{{route('piso.create', $id_est)}}" method="get">
            <button type="submit" class="btn btn-success" style="width: 50%;">Agregar</button>
        </form>
    </div>
    @if (count($pisos) == 0)
    <p>pisos sin registrar</p>
    @else
    <div class="container table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Código</th>
                    <th scope="col">Estante</th>
                    <th scope="col">Mantenimineto</th>
                    <th scope="col">Fecha Mantenimiento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @inject('carbon', 'Carbon\Carbon')
                @foreach ($pisos as $piso)
                @php
                $fechaMant = $carbon::parse($piso->fecha_mant);
                $hoy = $carbon::today();
                $mant = $fechaMant->lt($hoy) ? true : false;
                @endphp

                <tr class="{{ $fechaMant->lt($hoy) ? 'text-danger' : '' }}">
                    <td class="align-middle" scope="row">{{$loop->index+1}}</td>
                    <td class="align-middle">{{$piso->id}}</td>
                    <td class="align-middle">{{$piso->estante}}</td>
                    <td class="align-middle">{{($piso->mant == 1) ? "Sí" : "No" }}</td>
                    <td class="align-middle">{{$piso->fecha_mant}}</td>
                    <td id="btns" class="align-middle" style="padding: 1rem;">
                        <div class="d-flex">
                            <form action="" method="get">
                                @csrf
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Pisos</button>
                            </form>
                            <form action="{{route('piso.p_mant', $piso->id)}}" method="post">
                                @csrf
                                @method('patch')
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Mantenimiento</button>
                            </form>
                            <form action="{{route('piso.destroy', $piso->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" style="margin: 4px;" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
               
            </tbody>
        </table>
    </div>
    @endif
</x-layout>