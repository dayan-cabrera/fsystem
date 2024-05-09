<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empresa</title>
</head>
<body>
    <main>
        <div class="container marketing pt-5">
            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading mb-5"> {{$empresa->nombre}}</h2>
                    <p class="lead">Director: <span class="text-muted">{{$empresa->director}}</span></p>
                    <p class="lead">Dirección: <span class="text-muted">{{$empresa->direccion}}</span></p>
                    <p class="lead">Teléfono: <span class="text-muted">{{$empresa->telefono}}</span></p>
                </div>

                <div class="col-lg-4">
                    <h2>Recusos humanos</h2>
                    <p>{{$empresa->recursos_humanos}}</p>
                </div>
                <div class="col-lg-4">
                    <h2>Contabilidad</h2>
                    <p>{{$empresa->contabilidad}}</p>
                </div>
                <div class="col-lg-4">
                    <h2>Secretario</h2>
                    <p>{{$empresa->secretario}}</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>