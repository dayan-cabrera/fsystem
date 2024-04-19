<x-layout>


    <div class="login-container">
        <div class="mb-3 p-2 w-full">
            <h1>Crear casilla</h1>
        </div>
        <form class="login-form" method="post" action="{{ route('casilla.store') }}">
            @csrf
            <div class="input-group">
                <label for="fecha_mant">Fecha Mantenimiento</label>
                <input type="date" id="fecha_mant" name="fecha_mant" required>
            </div>

            <input type="hidden" name="id_piso" value="{{$id_piso}}">
            
            <button type="submit">Agregar</button>
        </form>
    </div>



</x-layout>