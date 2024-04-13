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


    @if(session()->has( 'error' ))
    <x-alert.error>
        {{session()->get('error')}}
    </x-alert.error>
    @endif


    <div class="login-container">
        <form class="login-form" method="post" action="{{route('auth')}}">
            @csrf
            <h1>Bienvenido</h1>
            <p>Ponga sus datos para ingresar a su cuenta</p>
            <div class="input-group">
                <input type="text" id="text" name="name" placeholder="Nombre de usuario" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <button class="" type="submit">Entrar</button>
            <div class="bottom-text">
                <p>¿No tienes cuenta aún? <a href="{{route('register')}}">Registrarse</a></p>
                {{-- <p><a href="#">Forgot password?</a></p> --}}
            </div>
        </form>
    </div>
    {{-- <script src="{{asset('js/sweetalert.js')}}"></script> --}}

</body>

</html>