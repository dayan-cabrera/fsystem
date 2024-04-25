<x-layout>
    <div class="login-container">
        <div class="mb-3 p-2 w-full">
            <h1>Generar Factura</h1>
        </div>
        <form class="login-form" method="post" action="{{ route('factura.store', $data) }}">
            @csrf
            <div class="input-group">
                <label for="id_empresa">Empresa</label>
                <select class="input-select" name="id_empresa" required>
                    @foreach ($empresas as $empresa)
                    <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                    @endforeach
                </select>
            </div>


            <div class="input-group">
                <label for="tarifa_tr">Tarifa Acordada</label>
                <input type="number" id="tarifa_tr" name="tarifa_tr" required>
            </div>

            {{-- <div class="input-group">
                <label for="tarifa_peso">Tarifa Peso</label>
                <input type="number" id="tarifa_peso" name="tarifa_peso" required>
            </div> --}}

            {{-- <div class="input-group">
                <label for="tarifa_tiempo">Tarifa Tiempo</label>
                <input type="number" id="tarifa_tiempo" name="tarifa_tiempo" required>
            </div> --}}

            {{-- <div class="input-group">
                <label for="tarifa_refr">Tarifa Refrigeración</label>
                <input type="number" id="tarifa_refr" name="tarifa_refr" required>
            </div> --}}

            {{-- <div class="input-group">
                <label for="tarifa_af">Tarifa Aforo</label>
                <input type="number" id="tarifa_af" name="tarifa_af" required>
            </div> --}}

            <div class="input-group">
                <label for="fecha_acordada">Fecha Acordada</label>
                <input type="date" id="fecha_acordada" name="fecha_acordada" required>
            </div>

            <div class="input-group">
                <label for="fecha_entrada">Fecha Entrada</label>
                <input type="date" id="fecha_entrada" name="fecha_entrada" required>
            </div>

            <div class="input-group">
                <label for="fecha_salida">Fecha Salida</label>
                <input type="date" id="fecha_salida" name="fecha_salida" required>
            </div>
            @foreach($data as $item)
            <input type="hidden" name="carga[]" value="{{ $item }}">
            @endforeach
            @foreach($cliente as $item)
            <input type="hidden" name="id_cliente[]" value="{{ $item }}">
            @endforeach
            <button type="submit">Agregar</button>
        </form>
    </div>
</x-layout>
