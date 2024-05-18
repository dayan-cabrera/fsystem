<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
</head>

<body>
    <main>
        <div class="container marketing pt-5">
            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading mb-5"> {{ $cliente->nombre }}</h2>
                    <p class="lead">Pais: <span class="text-muted">{{ $cliente->pais }}</span></p>
                    <p class="lead">Fax: <span class="text-muted">{{ $cliente->fax }}</span></p>
                    <p class="lead">Email: <span class="text-muted">{{ $cliente->email }}</span></p>
                    <p class="lead">Prioridad: <span class="text-muted">{{ $cliente->prioridad }}</span></p>
                    <p class="lead">Telefono: <span class="text-muted">{{ $cliente->telefono }}</span></p>
                    <p class="lead">Años: <span class="text-muted">{{ $cliente->anos }}</span></p>
                    <p class="lead">Archivado: <span class="text-muted">{{ $cliente->archivado }}</span></p>
                    <p class="lead">Entidad: <span class="text-muted">{{ $cliente->entidad }}</span></p>
                </div>

                <!-- Secciones adicionales pueden seguir aquí -->

            </div>
        </div>
    </main>
</body>

</html>
