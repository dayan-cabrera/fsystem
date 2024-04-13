@extends('adminlte::page')

@section('title', 'Monper')

@section('content')
@if (session()->has('success'))
<x-alert.success></x-alert.success>
@endif
@if (session()->has('error'))
<x-alert.error>
    {{session()->get('error')}}
</x-alert.error>
@endif

<div class="text-center p-4 add">
    <h1>Cree las categorías de sus servicios</h1>
    <form action="{{route('admin.categories.create')}}" method="get" class="ml-2">
        @csrf
        <button type="submit" class="btn success">
            <i class="fas fa-plus"></i>
        </button>
    </form>
</div>

<div class="container table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Categoría (es)</th>
                <th scope="col">Categoría (en)</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category )
            <tr>
                <td class="align-middle" scope="row" style="width: 35%;">{{$category->nameEs}}</td>
                <td class="align-middle" style="width: 35%;">{{$category->nameEn}}</td>
                <td id="btns" class="align-middle" style="width: 35%; padding: 1rem;">
                    <div class="d-flex">

                        <form action="{{route('admin.services.index', $category->id)}}" method="get">
                            <button style="margin: 4px;" class="btn btn-sm btn-info">Servicios</button>
                        </form>
                        {{-- <form action="">
                            <button style="margin: 4px;" class="btn btn-sm btn-info">Editar</button>
                        </form> --}}
                        <form action="{{route('admin.categories.destroy', $category->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" style="margin: 4px;" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </div>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@stop
@section('css')

<style>
    .add {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .success {
        background-color: transparent;
        /* border-color: #28a745; */
    }

    .success:hover {
        background-color: #28a745;
        border-color: green;
    }

    .success i {
        color: #28a745;
    }

    .success:hover i {
        color: white;
    }
</style>
</style>
<link rel="stylesheet" href="{{asset('css/create.css')}}">

<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!'); 
</script>
@stop