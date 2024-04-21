<x-layout>
    <main>

        <div class="container marketing pt-5">
      
            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                  <h2 class="featurette-heading mb-5"> {{$empresa->nombre}}</h2>
                  <p class="lead">Director: <span class="text-muted">{{$empresa->director}}</span></p>
                  <p class="lead">Dirección: <span class="text-muted">{{$empresa->direccion}}</span></p>
                  <p class="lead">Teléfono: <span class="text-muted">{{$empresa->telefono}}</span></p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="{{asset('images/'.$empresa->logo)}}" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" alt="">
                </div>
              </div>
            </div>
            <hr class="featurette-divider">
            
            <div class="row">
                <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
        
                <h2>Recusos humanos</h2>
                <p>{{$empresa->recursos_humanos}}</p>
                </div>
                <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
        
                <h2>Contabilidad</h2>
                <p>{{$empresa->contabilidad}}</p>
                </div>
                <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
        
                <h2>Secretario</h2>
                <p>{{$empresa->secretario}}</p>
                </div>
            </div>

            @hasrole('Administrador')
            
            <form action="{{route('empresa.edit')}}" method="get">
                <button class="btn btn-success mt-5 p-2 mb-5" type="submit" style="width: 100%" href="#">Actualizar información</button>
            </form>
            @endhasrole

      
        </div>
      
      </main>
</x-layout>
