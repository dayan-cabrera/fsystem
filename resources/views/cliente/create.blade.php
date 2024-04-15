<x-layout>

    
    
<div class="login-container">
    <div class="mb-3 p-2 w-full">
        <h1>Nuevo cliente</h1>
    </div>
    <form class="login-form" method="post" action="{{route('cliente.store')}}">
        @csrf
        <div class="input-group">
            <label for="nameEs" class="">Nombre</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="input-group">
            <label for="nameEn" class="">País</label>
            <input type="text" name="pais" required>
        </div>

        <div class="input-group">
            <label for="nameEs" class="">Teléfono</label>
            <input type="text" name="telefono" required>
        </div>
        
        <div class="input-group">
            <label for="nameEn" class="">Fax</label>
            <input type="text" name="fax" required>
        </div>

        <div class="input-group">
            <label for="nameEs" class="">Email</label>
            <input type="email" name="email" required>
        </div>
        
        <div class="input-group">
            <label for="nameEn" class="">Años</label>
            <input type="number" name="anos" required>
        </div>
        
        <div class="input-group">
            <label for="prioridad" class="">VIP</label>
            <input type="hidden" name="prioridad" value="0">
            <input type="checkbox" name="prioridad" value="1">
        </div>
        
        <div class="input-group">
            <label for="entidad" class="">Entidad</label>
            <input type="hidden" name="entidad" value="0">
            <input type="checkbox" name="entidad" value="1">
        </div>
        
        <button type="submit">Crear</button>
    </form>
</div>


</x-layout>