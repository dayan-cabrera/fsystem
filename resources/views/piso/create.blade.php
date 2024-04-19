<x-layout>


    <div class="login-container">
        <div class="mb-3 p-2 w-full">
            <h1>Crear piso</h1>
        </div>
        <form class="login-form" method="post" action="{{ route('piso.store') }}">
            @csrf
            <div class="input-group">
                <label for="fecha_mant">Fecha Mantenimiento</label>
                <input type="date" id="fecha_mant" name="fecha_mant" required>
            </div>

            <input type="hidden" name="id_estante" value="{{$id_est}}">
            
            <button type="submit">Agregar</button>
        </form>
    </div>



</x-layout>