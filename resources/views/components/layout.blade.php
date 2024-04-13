@extends('adminlte::page')

@section('title', 'SF')

@section('content')
@if (session()->has('success'))
<x-alert.success></x-alert.success>
@endif
@if (session()->has('error'))
<x-alert.error>
    {{session()->get('error')}}
</x-alert.error>
@endif

{{$slot}}

@stop
@section('css')

<link rel="stylesheet" href="{{asset('css/create.css')}}">

@stop

@section('js')
@stop