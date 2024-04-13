<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>

    @if(session()->has('error'))
    <x-alert.error>
        {{session()->get('error')}}
    </x-alert.error>
    @endif
    
    
    <div class="login-container">
        <form class="login-form" method="post" action="{{route('saveUser')}}">
            @csrf
            <h1>Bienvendo</h1>
            <p>Ingrese sus datos para crear su cuenta</p>
            <div class="input-group">
                <input type="text" id="name" name="name" placeholder="Nombre" required>
            </div>
           
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit">Registrarse</button>
            <div class="bottom-text">
                <p>¿Ya tiene una cuenta? <a href="{{route('login')}}">Acceder</a></p>
                {{-- <p><a href="#">Forgot password?</a></p> --}}
            </div>
        </form>
    </div>
    
    
</body>
</html>