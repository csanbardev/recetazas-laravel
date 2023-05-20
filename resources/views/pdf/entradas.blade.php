@extends('layout/template')
@section('titulo', 'Recetazas | Inicio')
@section('contenido')
    

  <div class="container center">

    <div class="dropdown">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Ordenar por fecha
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ url('/') }}">Más reciente primero</a>
        <a class="dropdown-item" href="{{ url('/asc') }}">Más antiguo primero</a>
      </div>
    </div>
    
    <h1>Todas las entradas</h1>
    
    <br>
    
    @if (count($entradas)<=0) 
      <h2>No hay entradas para mostrar :C</h2>
    @endif
    
    <div class="row">
      
      @foreach ($entradas as $dato) 
      

        <div class="shadow-lg card col-lg-4 p-2" style="width:400px">
          <img class="card-img-top" src={{'images/' . $dato->imagen}} alt="Card image">
          <div class="card-body">
            <h4 class="card-title">{{$dato->titulo}} </h4>
            <p class="card-text">{{$dato->descripcion}} </p>
            <span class="badge badge-secondary">{{date("d-m-Y", strtotime($dato->fecha))}} </span>
          </div>
        </div>

      @endforeach
      

    </div>
    
    <br>
    
  </div>

 
  @endsection