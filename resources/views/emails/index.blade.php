<x-layout>


    <div class="login-container">
        <div class="mb-3 p-2 w-full">
            <h1>Enviar Email</h1>
        </div>
        <form class="login-form" method="post" action="{{ route('enviar.email') }}" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <label for="asunto">Asunto</label>
                <input type="text" id="asunto" name="asunto" required>
            </div>

            <div class="input-group">
                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea>
            </div>

            <div class="input-group">
                <label for="destinatario">Destinatario</label>
                <input type="email" id="destinatario" name="destinatario" required>
            </div>

            <div class="input-group">
                <label for="archivos_pdf">Adjuntar PDFs</label>
                <input type="file" id="archivos_pdf" name="archivos_pdf[]" multiple>
            </div>

            <button type="submit">Enviar</button>
        </form>
    </div>



</x-layout>
