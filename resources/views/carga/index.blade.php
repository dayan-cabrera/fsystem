<x-layout>
    <div class="text-center p-4 add">
        <h1>Gestión de cargas</h1>
        <form action="{{route('carga.create')}}" method="get">
            <button type="submit" class="btn btn-success" style="width: 50%;">Agregar</button>
        </form>
    </div>
    @if (count($cargas) == 0)
    <p>cargas sin registrar</p>
    @else

    
    <div class="container table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Código</th>
                <th scope="col">Cliente</th>
                <th scope="col">Compania</th>
                <th scope="col">Tipo prodoductos</th>
                <th scope="col">Casilla</th>
                <th scope="col">Empaquetado</th>
                <th scope="col">Peso</th>
                <th scope="col">Fecha expiracion</th>
                <th scope="col">Refrigerado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cargas as $carga )
            <tr>
                <td class="align-middle" scope="row" >{{$loop->index+1}}</td>
                <td class="align-middle">{{$carga->nombre}}</td>
                <td class="align-middle">{{$carga->codigo}}</td>
                <td class="align-middle">{{$carga->cliente}}</td>
                <td class="align-middle">{{$carga->compania}}</td>
                <td class="align-middle">{{$carga->tipo_producto}}</td>
                <td class="align-middle">{{$carga->id_casilla}}</td>
                <td class="align-middle">{{$carga->empaquetado}}</td>
                <td class="align-middle">{{$carga->peso}}</td>
                <td class="align-middle">{{$carga->fechaexp}}</td>
                <td class="align-middle">{{($carga->condrefrig == 1) ? "Sí" : "No" }}</td>
                <td id="btns" class="align-middle" style=" padding: 1rem;">
                    <div class="d-flex">
                        
                        <form action="{{route('carga.edit', $carga->id)}}" method="get">
                            <button style="margin: 4px;" class="btn btn-sm btn-info">Editar</button>
                        </form>
                        <form action="{{route('carga.destroy', $carga->id)}}" method="post">
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
    @endif
</div>

</x-layout>