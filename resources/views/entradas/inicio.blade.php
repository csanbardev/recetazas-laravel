@extends('layout/template')
@section('titulo', 'Recetazas | Inicio')
@section('contenido')
    

  <div class="container center">


    
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
          <div class="pt-4">
            <a href="{{route('entradas.show',$dato)}}" class="btn btn-secondary">Detalle</a>
          </div>
        </div>

      @endforeach
      

    </div>
    
    <br>
    
    {{$entradas->links()}}
  </div>

 
  @endsection