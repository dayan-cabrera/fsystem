<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carga</title>
</head>

<body>
    <main>
        <div class="container marketing pt-5">
            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading mb-5"> {{ $carga->nombre }}</h2>
                    <p class="lead">Codigo <span class="text-muted">{{ $carga->codigo }}</span></p>
                    <p class="lead">Fecha expiracion <span class="text-muted">{{ $carga->fechaexp }}</span></p>
                    <p class="lead">Id tipoprod <span class="text-muted">{{ $carga->id_tipoprod }}</span></p>
                    <p class="lead">Id empaquetado: <span class="text-muted">{{ $carga->id_empaquetado }}</span></p>
                    <p class="lead">Id compania <span class="text-muted">{{ $carga->id_compania }}</span>
                    </p>
                    <p class="lead">Id casilla <span class="text-muted">{{ $carga->id_casilla }}</span></p>
                </div>

                <div class="col-lg-4">
                    <h2>Id cliente</h2>
                    <p>{{ $carga->id_cliente }}</p>
                </div>
                <div class="col-lg-4">
                    <h2>Condicion de refrigerado</h2>
                    <p>{{ $carga->condrefrig }}</p>
                </div>
                <div class="col-lg-4">
                    <h2>Peso</h2>
                    <p>{{ $carga->peso }}</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
