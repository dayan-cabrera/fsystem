<x-layout>

    <div class="text-center p-4 add">
        <h1>Gestión de cuentas</h1>
    
    </div>
    
    <div class="container table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Rol</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user )
            <tr>
                <td class="align-middle" scope="row" style="width: 35%;">{{$loop->index+1}}</td>
                <td class="align-middle" style="width: 35%;">{{$user->name}}</td>
                <td class="align-middle" style="width: 35%;">{{(count($user->roles) > 0) ? $user->roles[0]->name : 'Sin definir'}}</td>
                <td id="btns" class="align-middle" style="width: 35%; padding: 1rem;">
                    <div class="d-flex">
                        
                        <form action="{{route('user.view_role', $user->id)}}" method="get">
                            <button style="margin: 4px;" class="btn btn-sm btn-info">Rol</button>
                        </form>
                        <form action="{{route('user.destroy', $user->id)}}" method="post">
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

</x-layout>