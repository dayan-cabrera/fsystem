<x-layout>

    <div class="login-container">
        <div class="mb-3 p-2 w-full">
            <h1>Editar almacen</h1>
        </div>
        <form class="login-form" method="post" action="{{ route('almacen.update', $almacen->id) }}">
            @csrf
            @method('PUT') <!-- O @method('PATCH') dependiendo de tu configuración -->
            <div class="input-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ $almacen->nombre }}" required>
            </div>

            <div class="input-group">
                <label for="fecha_mant">Fecha Mantenimiento</label>
                <input type="date" id="fecha_mant" name="fecha_mant" value="{{ $almacen->fecha_mant }}" required>
            </div>

            <div class="input-group">
                <label for="id_empresa">Empresa</label>
                <select class="input-select" name="id_empresa">
                    @foreach ($empresas as $empresa)
                    <option value="{{$empresa->id}}" {{ $almacen->id_empresa == $empresa->id ? 'selected' : '' }}>{{$empresa->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label for="condrefrigerado" class="">Condición de Refrigeración</label>
                <input type="hidden" name="condrefrigerado" value="0">
                <input type="checkbox" id="condrefrigerado" name="condrefrigerado" value="1" {{ $almacen->condrefrigerado ? 'checked' : '' }}>
            </div>


            <button type="submit">Actualizar</button>
        </form>
    </div>

</x-layout>