<x-layout>
    <div class="text-center p-4 add">
        <h1>Gestión de compañias</h1>
        <form action="{{ route('compania.create') }}" method="get">
            <button type="submit" class="btn btn-success" style="width: 50%;">Agregar</button>
        </form>
    </div>
    @if (count($companias) == 0)
        <p>companias sin registrar</p>
    @else
        <div class="container table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo Compañía</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Seguridad</th>
                        <th scope="col">Cond. alm</th>
                        <th scope="col">Prioridad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companias as $compania)
                        <tr>
                            <td class="align-middle" scope="row">{{ $loop->index + 1 }}</td>
                            <td class="align-middle">{{ $compania->nombre }}</td>
                            <td class="align-middle">{{ $compania->compania }}</td>
                            <td class="align-middle">{{ $compania->empresa }}</td>
                            <td class="align-middle">{{ $compania->seguridad }}</td>
                            <td class="align-middle">{{ $compania->cond_alm }}</td>
                            <td class="align-middle">{{ $compania->prioridad }}</td>
                            <td id="btns" class="align-middle" style="padding: 1rem;">
                                <div class="d-flex">
                                    <form action="{{ route('compania.imprimir', $compania->id) }}" method="get">
                                        <button class="btn btn-sm btn-info" type="submit" style="margin: 4px;"
                                            href="#">Descargar</button>
                                    </form>
                                    <form action="{{ route('compania.edit', $compania->id) }}" method="get">
                                        @csrf
                                        <button style="margin: 4px;" class="btn btn-sm btn-info">Editar</button>
                                    </form>
                                    <form action="{{ route('compania.destroy', $compania->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" style="margin: 4px;"
                                            class="btn btn-sm btn-danger">Eliminar</button>
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
