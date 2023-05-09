@extends('layout/template')
@section('titulo', 'Recetazas | Detalle')

@section('contenido')
 
 
  <div class="container mx-auto">
    <div class="shadow-lg card mx-auto p-2" style="width:400px; margin-top: 6rem;">
      <img class="card-img-top" src={{'images/' . $entradas->imagen}} alt="Card image">
      <div class="card-body">
        <h4 class="card-title">{{$entradas->titulo}} </h4>
        <p class="card-text">{{$entradas->descripcion}} </p>
        <span class="badge badge-primary">Autor: {{$usuario->name}} </span><br>
        <span class="badge badge-secondary">{{$categoria->nombre}} </span>
        <span class="badge badge-secondary">{{date("d-m-Y", strtotime($entradas->fecha))}} </span>
      </div>
    </div>
  </div>


@endsection