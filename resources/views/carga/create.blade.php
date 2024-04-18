<x-layout>

    
    
<div class="login-container">
    <div class="mb-3 p-2 w-full">
        <h1>Nueva carga</h1>
    </div>
    <form class="login-form" method="post" action="{{route('carga.store')}}">
        @csrf
        <div class="input-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="input-group">
            <label for="codigo">Código</label>
            <input type="text" id="codigo" name="codigo" required>
        </div>

        <div class="input-group">
            <label for="fechaexp">Fecha Expiración</label>
            <input type="date" id="fechaexp" name="fechaexp" required>
        </div>

        <div class="input-group">
            <label for="id_tipoprod">Tipo de Producto</label>
            <select class="input-select" name="id_tipoprod">
                @foreach ($tipos_productos as $producto)
                <option value="{{$producto->id}}">{{$producto->tipo}}</option>
                @endforeach
            </select>
         </div>

        <div class="input-group">
            <label for="id_empaquetado">Empaquetado</label>
            <select class="input-select" name="id_empaquetado">
                @foreach ($tipos_empaquetado as $empaquetado)
                <option value="{{$empaquetado->id}}">{{$empaquetado->tipo}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="id_compania">Compañía</label>
            <select class="input-select" name="id_compania">
                @foreach ($companias as $compania)
                <option value="{{$compania->id}}">{{$compania->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="id_casilla">Casilla</label>
            <select class="input-select" name="id_casilla">
                @foreach ($casillas as $casilla)
                <option value="{{$casilla->id}}">{{$casilla->id}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="id_cliente">Cliente</label>
            <select class="input-select" name="id_cliente">
                @foreach ($clientes as $cliente)
                <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                @endforeach
            </select>
        </div>

        
        <div class="input-group">
            <label for="peso">Peso</label>
            <input type="number" id="peso" name="peso" required>
        </div>


        <div class="input-group">
            <label for="condrefrig" class="">Condición de Refrigeración</label>
            <input type="hidden" name="condrefrig" value="0">
            <input type="checkbox" name="condrefrig" value="1">
        </div>


        <button type="submit">Crear</button>
    </form>
</div>



</x-layout>