<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('titulo')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    

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

