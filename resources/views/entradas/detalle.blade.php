@extends('layout/template')
@section('titulo', 'Recetazas | Detalle')

@section('contenido')


    <div class="container mx-auto ">
        <h1 class="text-center">{{ $entradas->titulo }}</h1>
        
        <!-- Descripcion breve-->
        <div class="text-center">
            <p><?= $entradas-> descripcion ?></p>
        </div>
        
            <img class="mx-auto d-block img-fluid pb-4" src="/images/{{ $entradas->imagen }}" alt="">
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
                @if($paso->imagen != null)
                
                    <img class="pb-4 pt-4" style="width: 35%" src="/images/{{ $paso->imagen }}" alt=""> 
                @endif
            @endforeach
        </ol>


    </div>


@endsection
