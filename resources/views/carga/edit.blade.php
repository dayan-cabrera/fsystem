<x-layout>

    
    
<div class="login-container">
    <div class="mb-3 p-2 w-full">
        <h1>Editar carga</h1>
    </div>
    <form class="login-form" method="post" action="{{route('carga.update', $carga->id)}}">
        @csrf
        @method('PUT')
        <div class="input-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{$carga->nombre}}" required>
        </div>

        <div class="input-group">
            <label for="fechaexp">Fecha Expedición</label>
            <input type="date" id="fechaexp" name="fechaexp" value="{{$carga->fechaexp}}" required>
        </div>

        <div class="input-group">
            <label for="id_tipoprod">Tipo de Producto</label>
            <select class="input-select" name="id_tipoprod">
                @foreach ($tipos_productos as $producto)
                <option value="{{$producto->id}}" {{ $producto->id == $carga->id_tipoprod ? 'selected' : '' }}>{{$producto->tipo}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="id_empaquetado">Empaquetado</label>
            <select class="input-select" name="id_empaquetado">
                @foreach ($tipos_empaquetado as $empaquetado)
                <option value="{{$empaquetado->id}}" {{ $empaquetado->id == $carga->id_empaquetado ? 'selected' : '' }}>{{$empaquetado->tipo}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="id_compania">Compañía</label>
            <select class="input-select" name="id_compania">
                @foreach ($companias as $compania)
                <option value="{{$compania->id}}" {{ $compania->id == $carga->id_compania ? 'selected' : '' }}>{{$compania->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="id_casilla">Casilla</label>
            <select class="input-select" name="id_casilla">
                @foreach ($casillas as $casilla)
                <option value="{{$casilla->id}}" {{ $casilla->id == $carga->id_casilla ? 'selected' : '' }}>{{$casilla->id}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="id_cliente">Cliente</label>
            <select class="input-select" name="id_cliente">
                @foreach ($clientes as $cliente)
                <option value="{{$cliente->id}}" {{ $cliente->id == $carga->id_cliente ? 'selected' : '' }}>{{$cliente->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="peso">Peso</label>
            <input type="number" id="peso" name="peso" value="{{$carga->peso}}" required>
        </div>

        <div class="input-group">
            <label for="condrefrig" class="">Condición de Refrigeración</label>
            <input type="hidden" name="condrefrig" value="0">
            <input type="checkbox" name="condrefrig" value="1" {{ $carga->condrefrig ? 'checked' : '' }}>
        </div>

        <button type="submit">Actualizar</button>
    </form>
</div>



</x-layout>