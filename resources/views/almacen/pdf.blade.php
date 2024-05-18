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
                    <h2 class="featurette-heading mb-5"> {{ $almacen->nombre }}</h2>
                    <p class="lead">Condición de Refrigerado: <span
                            class="text-muted">{{ $almacen->condrefrigerado }}</span></p>
                    <p class="lead">Fecha Mantenimiento: <span class="text-muted">{{ $almacen->fecha_mant }}</span>
                    </p>
                </div>

                <!-- Secciones adicionales pueden seguir aquí -->

            </div>
        </div>
    </main>
</body>

</html>
