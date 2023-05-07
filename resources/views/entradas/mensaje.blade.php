@extends('layout/template')
@section('titulo', 'Recetazas | Confirmando')

@section('contenido')
@isset($mensaje)
    <div class="alert alert-success">
        {{ $mensaje }}
    </div>
@endisset

<a href={{url('/')}} class="btn ">Volver
</a>
@endsection