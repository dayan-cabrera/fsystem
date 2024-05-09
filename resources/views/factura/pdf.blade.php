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
                    <h2 class="featurette-heading mb-5"> {{$factura->cliente}}</h2>
                    <p class="lead">Tarifa acordada: <span class="text-muted">{{$factura->tarifa_tr}}</span></p>
                    <p class="lead">Tarifa peso: <span class="text-muted">{{$factura->tarifa_peso}}</span></p>
                    <p class="lead">Tarifa tiempo: <span class="text-muted">{{$factura->tarifa_tiempo}}</span></p>
                    <p class="lead">Tarifa peso: <span class="text-muted">{{$factura->tarifa_peso}}</span></p>
                    <p class="lead">Tarifa por refrigeración <span class="text-muted">{{$factura->tarifa_refr}}</span></p>
                    <p class="lead">Tarifa af <span class="text-muted">{{$factura->tarifa_af}}</span></p>
                </div>

                <div class="col-lg-4">
                    <h2>Fecha acordada</h2>
                    <p>{{$factura->fecha_acordada}}</p>
                </div>
                <div class="col-lg-4">
                    <h2>Fecha entrada</h2>
                    <p>{{$factura->fecha_entrada}}</p>
                </div>
                <div class="col-lg-4">
                    <h2>Fecha de salida</h2>
                    <p>{{$factura->fecha_salida}}</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>