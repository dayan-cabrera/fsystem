<x-layout>
    <div class="text-center p-4 add">
        <h1>Gestión de clientes</h1>
        <form action="" class="">
            <button class="btn btn-success" style="width: 50%;">Agregar</button>

        </form>
    </div>
    @if (count($clientes) != 0)
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
                <th scope="col">Empresa</th>
                <th scope="col">Prioridad</th>
                <th scope="col">Archivado</th>
                <th scope="col">Entidad</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente )
            <tr>
                <td class="align-middle" scope="row" style="width: 35%;">{{$loop->index+1}}</td>
                <td class="align-middle" style="width: 35%;"></td>
                <td class="align-middle" style="width: 35%;"></td>
                <td id="btns" class="align-middle" style="width: 35%; padding: 1rem;">
                    <div class="d-flex">
                        
                        <form action="" method="get">
                            <button style="margin: 4px;" class="btn btn-sm btn-info">Rol</button>
                        </form>
                        <form action="" method="post">
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