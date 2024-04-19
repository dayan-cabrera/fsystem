<x-layout>

    <div class="text-center p-4 add">
        <h1>Mantenimiento</h1>
        <!-- <form action="{{route('almacen.create')}}" method="get">
            <button type="submit" class="btn btn-success" style="width: 50%;">Agregar</button>
        </form> -->
    </div>
    @if (count($almacenes) != 0)
    <h1>Almacenes</h1>
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
                @foreach ($almacenes as $almacen)
                <tr>
                    <td class="align-middle" scope="row">{{$loop->index+1}}</td>
                    <td class="align-middle">{{$almacen->nombre}}</td>
                    <td class="align-middle">{{$almacen->empresa}}</td>
                    <td class="align-middle">{{($almacen->condrefrigerado == 1) ? "Sí" : "No" }}</td>
                    <td class="align-middle">{{($almacen->mantorep == 1) ? "Sí" : "No" }}</td>
                    <td class="align-middle">{{$almacen->fecha_mant}}</td>
                    <td id="btns" class="align-middle" style="padding: 1rem;">
                        <div class="d-flex">
                            <form action="{{route('almacen.mant.edit', $almacen->id)}}" method="get">
                                @csrf
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Terminar Mantenimiento</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="display:flex; justify-content:end;">
            {{$almacenes->links()}}
        </div>
    </div>
    @endif

    @if (count($estantes) != 0)
    <h1>Estantes</h1>
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
                @foreach ($estantes as $estante)
                <tr>
                    <td class="align-middle" scope="row">{{$loop->index+1}}</td>
                    <td class="align-middle">{{$estante->id}}</td>
                    <td class="align-middle">{{$estante->almacen}}</td>
                    <td class="align-middle">{{($estante->mant == 1) ? "Sí" : "No" }}</td>
                    <td class="align-middle">{{$estante->fecha_mant}}</td>
                    <td id="btns" class="align-middle" style="padding: 1rem;">
                        <div class="d-flex">
                            <form action="{{route('estante.mant.edit', $estante->id)}}" method="get">
                                @csrf
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Terminar Mantenimiento</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="display:flex; justify-content:end;">
            {{$estantes->links()}}
        </div>
    </div>
    @endif

    @if (count($pisos) != 0)
    <h1>Pisos</h1>
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
                @foreach ($pisos as $piso)
                <tr>
                    <td class="align-middle" scope="row">{{$loop->index+1}}</td>
                    <td class="align-middle">{{$piso->id}}</td>
                    <td class="align-middle">{{$piso->estante}}</td>
                    <td class="align-middle">{{($piso->mant == 1) ? "Sí" : "No" }}</td>
                    <td class="align-middle">{{$piso->fecha_mant}}</td>
                    <td id="btns" class="align-middle" style="padding: 1rem;">
                        <div class="d-flex">
                            <form action="{{route('piso.mant.edit', $piso->id)}}" method="get">
                                @csrf
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Terminar Mantenimiento</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="display:flex; justify-content:end;">
            {{$pisos->links()}}
        </div>
    </div>
    @endif

    @if (count($casillas) != 0)
    <h1>Casillas</h1>
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
                @foreach ($casillas as $casilla)
                <tr>
                    <td class="align-middle" scope="row">{{$loop->index+1}}</td>
                    <td class="align-middle">{{$casilla->id}}</td>
                    <td class="align-middle">{{$casilla->piso}}</td>
                    <td class="align-middle">{{($casilla->mant == 1) ? "Sí" : "No" }}</td>
                    <td class="align-middle">{{$casilla->fecha_mant}}</td>
                    <td id="btns" class="align-middle" style="padding: 1rem;">
                        <div class="d-flex">
                            <form action="{{route('estante.mant.edit', $casilla->id)}}" method="get">
                                @csrf
                                <button style="margin: 4px;" class="btn btn-sm btn-info">Terminar Mantenimiento</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="display:flex; justify-content:end;">
            {{$casillas->links()}}
        </div>
    </div>
    @endif
</x-layout>