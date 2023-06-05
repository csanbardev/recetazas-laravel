@extends('layout/template')
@section('titulo', 'Recetazas | Inicio')
@section('contenido')
    <section id="banner">
        <div id="img-banner-container">
            <img src="images/banner-principal.jpg" alt="" class="img-fluid">
        </div>
        <div id="text-banner-container">
            <h2>Recetazas</h2>
            <p>Aprende a cocinar recetas de toda la vida</p>
        </div>
        
    </section>

    <div class="container center">

      <h1 class="title">Nuestras Recetas</h1>
      <div class="dropdown">
          <button type="button" class="bt dropdown-toggle" data-toggle="dropdown">
              Ordenar por fecha
          </button>
          <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('/') }}">Más reciente primero</a>
              <a class="dropdown-item" href="{{ url('/asc') }}">Más antiguo primero</a>
          </div>
      </div>

    <br>

    @if (count($entradas) <= 0)
        <h2>No hay entradas para mostrar :C</h2>
    @endif

    <div class="row">

        @foreach ($entradas as $dato)
            <a 
                href="{{ route('entradas.show', $dato) }}" class="card col-lg-4 p-4" style="width:400px">
                <img class="card-img-top" src={{ 'images/' . $dato->imagen }} alt="Card image">
                <div class="card-body">
                    <h4 class="card-title">{{ $dato->titulo }} </h4>
                    <p class="card-text"><?= $dato->descripcion ?> </p>
                    <span class="badge badge-secondary">{{ date('d-m-Y', strtotime($dato->fecha)) }} </span>
                </div>

            </a>
        @endforeach


    </div>

    <br>

    {{ $entradas->links() }}
    <br>
    <br>
    <a class="bt" href="{{ url('/imprimir') }}">imprimir listado</a>
    </div>


@endsection
