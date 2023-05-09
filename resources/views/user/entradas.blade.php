@extends('layout/template')
@section('titulo', 'Recetazas | Listado')

@section('contenido')
<div class="container center">

 
    
  <h1>Todas las entradas</h1>
  <br>
  
  
  @if ($entradas == null) 
    <h2>No hay entradas para mostrar :C</h2>
  @else
  
  <div class="row">
    
    @foreach ($entradas as $dato) 
    

      <div class="shadow-lg card col-lg-4 p-2" style="width:400px">
        <img class="card-img-top" src={{'images/' . $dato->imagen}} alt="Card image">
        <div class="card-body">
          <h4 class="card-title">{{$dato->titulo}} </h4>
          <p class="card-text">{{$dato->descripcion}} </p>
          <span class="badge badge-primary">Autor: {{$dato->nick}} </span><br>
          <span class="badge badge-secondary">{{$dato->nombre}} </span>
          <span class="badge badge-secondary">{{date("d-m-Y", strtotime($dato->fecha))}} </span>
          <a href="{{route('entradas.show',$dato)}}">Detalle</a>
        </div>
      </div>

    @endforeach
    

  </div>
  @endif
  <br>
 
 {{$entradas->links()}}
</div>

@endsection