<x-layout>

    
<div class="login-container">
    <div class="mb-3 p-2 w-full">
        <h1>Crear almacen</h1>
    </div>
    <form class="login-form" method="post" action="{{ route('almacen.store') }}">
        @csrf
        <div class="input-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="input-group">
            <label for="fecha_mant">Fecha Mantenimiento</label>
            <input type="date" id="fecha_mant" name="fecha_mant" required>
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
            <label for="condrefrigerado" class="">Condición de Refrigeración</label>
            <input type="hidden" name="condrefrigerado" value="0">
            <input type="checkbox" id="condrefrigerado" name="condrefrigerado" value="1" >
        </div>

        <div class="input-group">
            <label for="mantorep" class="">Mantenimiento</label>
            <input type="hidden" name="mantorep" value="0">
            <input type="checkbox" id="mantorep" name="mantorep" value="1" >
        </div>

        <button type="submit">Agregar</button>
    </form>
</div>



</x-layout>