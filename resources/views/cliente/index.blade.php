<x-layout>
    <div class="text-center p-4 add">
        <h1>Gestión de clientes</h1>
        <form action="{{route('cliente.create')}}" method="get">
            <button type="submit" class="btn btn-success" style="width: 50%;">Agregar</button>
        </form>
    </div>
    @if (count($clientes) == 0)
    <p>Clientes sin registrar</p>
    @else

    
    <div class="container table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Edad</th>
                <th scope="col">Email</th>
                <th scope="col">Pais</th>
                <th scope="col">Fax</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Prioridad</th>
                <th scope="col">Archivado</th>
                <th scope="col">Entidad</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente )
            <tr>
                <td class="align-middle" scope="row" >{{$loop->index+1}}</td>
                <td class="align-middle">{{$cliente->nombre}}</td>
                <td class="align-middle">{{$cliente->anos}}</td>
                <td class="align-middle">{{$cliente->email}}</td>
                <td class="align-middle">{{$cliente->pais}}</td>
                <td class="align-middle">{{$cliente->fax}}</td>
                <td class="align-middle">{{$cliente->telefono}}</td>
                <td class="align-middle">{{($cliente->prioridad != 0) ? 'Sí' : 'No'}}</td>
                <td class="align-middle">{{($cliente->archivado != 0) ? 'Sí' : 'No'}}</td>
                <td class="align-middle">{{($cliente->entidad != 0) ? 'Sí' : 'No'}}</td>
                <td id="btns" class="align-middle" style=" padding: 1rem;">
                    <div class="d-flex">
                        
                        <form action="" method="get">
                            <button style="margin: 4px;" class="btn btn-sm btn-info">Editar</button>
                        </form>
                        <form action="{{route('cliente.destroy', $cliente->id)}}" method="post">
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