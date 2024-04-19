<x-layout>
    <div class="login-container">
        <div class="mb-3 p-2 w-full">
            <h1>Establecer nueva fecha de mantenimiento</h1>
        </div>
        <form class="login-form" method="post" action="{{ route('piso.q_mant', $piso->id) }}">
            @csrf
            @method('patch')

            <div class="input-group">
                <label for="fecha_mant">Fecha Mantenimiento</label>
                <input type="date" id="fecha_mant" name="fecha_mant" value="{{ $piso->fecha_mant }}">
            </div>


            <button type="submit">Actualizar</button>
        </form>
    </div>

</x-layout>