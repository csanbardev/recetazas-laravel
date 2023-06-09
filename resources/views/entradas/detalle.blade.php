@extends('layout/templatemain')
@section('titulo', 'Recetazas | Detalle')

@section('contenido')

    <div id="show-view">
        <!-- BANNER -->
        <div class="text-banner-container">
            <div id="categories">
                <span  class="text-center badge badge-info ">{{$categoria->nombre}}</span>
            </div>
            <h1 class="text-center">{{ $entradas->titulo }}</h1>
            <h3 class="text-center">{{$entradas->subtitulo}}</h3>
            <p id="autor" class="text-center">— {{$usuario->name}} —</p>
        </div>
        <img class="mx-auto d-block pb-4" src="/images/{{ $entradas->imagen }}" alt="">

    </div>


    <hr>


    <div id="content" class="container mx-auto ">

        <!-- Descripcion breve-->
        <div id="recipe-description-container"  >
            <?= $entradas->descripcion ?>
        </div>
        <hr>

        <h3 class="text-center">Receta de {{$entradas->titulo}}</h3>
        <hr>

        <h3>Ingredientes</h3>


        <ul>
            @foreach ($ingredientes as $ing)
                <li>{{ $ing->name }}: {{ $ing->cantidad }} {{ $ing->tipoCant }}</li>
            @endforeach
        </ul>
        <h3>Preparación</h3>
        <ol>
            @foreach ($pasos as $paso)
                <li>{{ $paso->secuencia }}</li>
                @if ($paso->imagen != null)
                    <img class="img-fluid mx-auto d-block rounded " src="/images/{{ $paso->imagen }}" alt="">
                @endif
            @endforeach
        </ol>


    </div>


@endsection
