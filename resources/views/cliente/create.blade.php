@extends('adminlte::page')

@section('title', 'Monper')

@section('content_header')
{{-- <h1>Dashboard</h1> --}}
{{-- <h1>Bienvenido</h1> --}}
@stop

@section('content')
@if (session()->has('success'))
<x-alert.success></x-alert.success>
@endif
@if (session()->has('error'))
<x-alert.error>
    {{session()->get('error')}}
</x-alert.error>
@endif

<div class="login-container">
    <div class="mb-3 p-2 w-full">
        <h1>Cree una nueva categoría para sus servicios</h1>
    </div>
    <form class="login-form" method="post" action="{{route('admin.categories.store')}}">
        @csrf
        <div class="input-group">
            <label for="nameEs" class="">Nombre</label>
            <input type="text" name="nameEs" placeholder="español" required>
        </div>

        <div class="input-group">
            <label for="nameEn" class="">Nombre</label>
            <input type="text" name="nameEn" placeholder="inglés" required>
        </div>
        <button type="submit">Crear</button>
    </form>
</div>


@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/create.css')}}">
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!'); 
</script>
@stop