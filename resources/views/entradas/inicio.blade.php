@extends('layout/template')
@section('titulo', 'Recetazas | Inicio')
@section('contenido')
    

  <div class="container center">


    
    <h1>Todas las entradas</h1>
    <br>
    <div class="dropdown" {{$parametros['datos'] == null ? 'style="display: none"' : '' }} >
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Ordenar por fecha
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="index.php?orden=desc">Más reciente primero</a>
        <a class="dropdown-item" href="index.php?orden=asc">Más antiguo primero</a>
      </div>
    </div>
    <br>
    
    @if ($parametros['datos'] == null) 
      <h2>No hay entradas para mostrar :C</h2>
    @else
    
    <div class="row">
      
      @foreach ($parametros["datos"] as $dato) 
      

        <div class="shadow-lg card col-lg-4 p-2" style="width:400px">
          <img class="card-img-top" src={{'images/' . $dato->imagen}} alt="Card image">
          <div class="card-body">
            <h4 class="card-title">{{$dato->titulo}} </h4>
            <p class="card-text">{{$dato->descripcion}} </p>
            <span class="badge badge-primary">Autor: {{$dato->nick}} </span><br>
            <span class="badge badge-secondary">{{$dato->nombre}} </span>
            <span class="badge badge-secondary">{{date("d-m-Y", strtotime($dato->fecha))}} </span>
          </div>
        </div>

      @endforeach
      

    </div>
    @endif
    <br>
   
    @if ($parametros['paginacion']!=null && $parametros['paginacion']->totalregistros >= 1) 
    
      <nav aria-label="Page navigation example" class="text-center">
        <ul class="pagination">

          
          @if ($parametros['paginacion']->pagina == 1) 
            <li class="page-item disabled"><a class="page-link" href="#<?= isset($_GET['orden']) ? '?orden=' . $_GET['orden'] : "" ?>">&laquo;</a></li>
          @else 
            <li class="page-item"><a class="page-link" href="index.php?pagina=<?php echo $parametros['paginacion']->pagina - 1; ?>&regsxpag=<?= $parametros['paginacion']->regsxpag ?><?= isset($_GET['orden']) ? '&orden=' . $_GET['orden'] : "" ?>"> &laquo;</a></li>
          
          @endif
          
          @for ($i = 1; $i <= $parametros['paginacion']->numpaginas; $i++)
            if ($parametros['paginacion']->pagina == $i) {
              // compruebo que se haya indicado un orden
              if (isset($_GET['orden'])) {
                echo '<li class="page-item active"> 
                <a class="page-link" href="index.php?pagina=' . $i . '&regsxpag=' . $parametros['paginacion']->regsxpag . '&orden=' . $_GET['orden'] . '">' . $i . '</a></li>';
              } else {
                echo '<li class="page-item active"> 
                <a class="page-link" href="index.php?pagina=' . $i . '&regsxpag=' . $parametros['paginacion']->regsxpag . '">' . $i . '</a></li>';
              }
            } else {
              // compruebo que se haya indicado un orden
              if (isset($_GET['orden'])) {
                echo '<li class="page-item"> 
                <a class="page-link" href="index.php?pagina=' . $i . '&regsxpag=' . $parametros['paginacion']->regsxpag . '&orden=' . $_GET['orden'] . '">' . $i . '</a></li>';
              } else {
                echo '<li class="page-item"> 
                  <a class="page-link" href="index.php?pagina=' . $i . '&regsxpag=' . $parametros['paginacion']->regsxpag . '">' . $i . '</a></li>';
              }
            }
          @endfor
          //Comprobamos si estamos en la última página. Si es así, deshabilitamos el botón 'siguiente'
          @if ($parametros['paginacion']->pagina == $parametros['paginacion']->numpaginas) : ?>
            <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
          @else 
            <li class="page-item"><a class="page-link" href="index.php?pagina=<?php echo $parametros['paginacion']->pagina + 1; ?>&regsxpag=<?= $parametros['paginacion']->regsxpag ?><?= isset($_GET['orden']) ? '&orden=' . $_GET['orden'] : "" ?>"> &raquo; </a></li>
          @endif
        </ul>

      </nav>

    @endif
    
    <a {{$parametros['datos'] == null ? 'style="display: none"' : '' }} href="index.php?accion=imprimirEntradas" class="btn btn-primary">Imprimir en pdf</a>
  </div>

 
  @endsection