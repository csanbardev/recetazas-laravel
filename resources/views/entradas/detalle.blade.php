@extends('layout/template')
@section('titulo', 'Recetazas | Detalle')

@section('contenido')


    <div class="container mx-auto ">
        <h1 class="text-center">{{ $entradas->titulo }}</h1>
        
        <!-- Descripcion breve-->
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam animi voluptatum quam vero maxime, id nesciunt
            incidunt assumenda ducimus at odit architecto voluptatibus? Iure adipisci voluptas reiciendis illum ea rem iusto
            ipsum esse repudiandae facilis libero, saepe dolorum corrupti veniam quos, cumque quia quod voluptate officiis
            commodi? Beatae, quo aspernatur! Praesentium adipisci ratione, ipsam eius repellat animi natus illum sit quia
            eaque commodi iure aliquid, in nemo temporibus consectetur amet suscipit autem distinctio, vero obcaecati
            provident expedita? Tempore facere error eos aperiam, modi nemo. Suscipit maxime voluptates aspernatur qui odio.
            Laudantium iusto molestias voluptatibus animi totam ratione quaerat ipsum repudiandae.</p>
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
            @endforeach
        </ol>


    </div>


@endsection
