<x-layout>

    <div class="login-container">
        <div class="mb-3 p-2 w-full">
            <h1>Editar información de la empresa</h1>
        </div>
        <form class="login-form" method="post" action="{{ route('empresa.update')}}" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <div class="input-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ $empresa->nombre }}" required>
            </div>

            <div class="input-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ $empresa->direccion }}" required>
            </div>

            <div class="input-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ $empresa->telefono }}" required>
            </div>

            <div class="input-group">
                <label for="director">Director</label>
                <input type="text" id="director" name="director" value="{{ $empresa->director }}" required>
            </div>

            <div class="input-group">
                <label for="recursos_humanos">Recursos Humanos</label>
                <input type="text" id="recursos_humanos" name="recursos_humanos" value="{{ $empresa->recursos_humanos }}" required>
            </div>

            <div class="input-group">
                <label for="contabilidad">Contabilidad</label>
                <input type="text" id="contabilidad" name="contabilidad" value="{{ $empresa->contabilidad }}" required>
            </div>

            <div class="input-group">
                <label for="secretario">Secretario</label>
                <input type="text" id="secretario" name="secretario" value="{{ $empresa->secretario }}" required>
            </div>

            <div class="input-group">
                <label for="logo">Logo</label>
                <input type="file" id="logo" name="logo" value="{{ $empresa->logo }}" required>
            </div>
           

            <button type="submit">Actualizar</button>
        </form>
    </div>

</x-layout>
