<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información de Compañía</title>
</head>

<body>
    <main>
        <div class="container marketing pt-5">
            <div class="row featurette">
                <div class="col-md-12">
                    <h2 class="featurette-heading mb-5">Información de la Compañía</h2>
                    <p class="lead">ID Tipo de Compañía: <span class="text-muted">{{ $compania->id_tipocomp }}</span>
                    </p>
                    <p class="lead">ID Seguridad: <span class="text-muted">{{ $compania->id_seguridad }}</span></p>
                    <p class="lead">ID Condominio: <span class="text-muted">{{ $compania->id_condalm }}</span></p>
                    <p class="lead">ID Prioridad: <span class="text-muted">{{ $compania->id_prioridad }}</span></p>
                    <p class="lead">ID Empresa: <span class="text-muted">{{ $compania->id_empresa }}</span></p>
                    <p class="lead">Nombre de la Compañía: <span class="text-muted">{{ $compania->nombre }}</span></p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
