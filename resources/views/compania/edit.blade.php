<x-layout>


    <div class="login-container">
        <div class="mb-3 p-2 w-full">
            <h1>Crear Compañía</h1>
        </div>
        <form class="login-form" method="post" action="{{ route('compania.update', $compania->id) }}">
            @csrf
            @method('put')
            <div class="input-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{$compania->nombre}}" required>
            </div>

            <div class="input-group">
                <label for="id_empresa">Empresa</label>
                <select class="input-select" name="id_empresa">
                    @foreach ($empresas as $empresa)
                    <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label for="id_tipocomp">Tipos de comañía</label>
                <select class="input-select" name="id_tipocomp">
                    @foreach ($tipos as $tipo)
                    <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label for="id_seguridad">Seguridades</label>
                <select class="input-select" name="id_seguridad">
                    @foreach ($seguridades as $seguridad)
                    <option value="{{$seguridad->id}}">{{$seguridad->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label for="id_condalm">Cond. Almacen</label>
                <select class="input-select" name="id_condalm">
                    @foreach ($condalms as $condalm)
                    <option value="{{$condalm->id}}">{{$condalm->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label for="id_prioridad">Prioridades</label>
                <select class="input-select" name="id_prioridad">
                    @foreach ($prioridades as $prioridad)
                    <option value="{{$prioridad->id}}">{{$prioridad->prioridad}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Actualizar</button>
        </form>
    </div>



</x-layout>