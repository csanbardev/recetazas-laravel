@extends('layout/template')
@section('titulo', 'Recetazas | Listado')

@section('contenido')
    <div class="container center">



        <h1>Entradas de {{ auth()->user()->name }}</h1>
        <br>
        @if (count($entradas) <= 0)
            <h2>No hay entradas para mostrar :C</h2>
        @endif

        <form class="form-inline" action="/action_page.php">
          <input class="form-control mr-sm-2" type="text" placeholder="Buscar entrada">
          <button class="btn btn-success" type="submit">Buscar</button>
        </form>
            <div class="row">

                @foreach ($entradas as $dato)
                    <div class="shadow-lg card col-lg-4 p-2" style="width:400px">
                        <img class="card-img-top" src={{ 'images/' . $dato->imagen }} alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title">{{ $dato->titulo }} </h4>
                            <p class="card-text">{{ $dato->descripcion }} </p>
                            <span class="badge badge-primary">Autor: {{ $dato->nick }} </span><br>
                            <span class="badge badge-secondary">{{ $dato->nombre }} </span>
                            <span class="badge badge-secondary">{{ date('d-m-Y', strtotime($dato->fecha)) }} </span>
                            <div class="pt-4">
                                <a href="{{ route('entradas.show', $dato) }}" class="btn btn-secondary">Detalle</a>
                                <a href="{{ url('entrada/' . $dato->id . '/edit') }}" class="btn btn-secondary">Editar</a>
                                <a class="btn btn-danger" data-toggle="modal"
                                    data-target=<?= '#modal-' . $dato['id'] ?>>Eliminar</a>
                            </div>

                        </div>
                    </div>
                    <!-- Ventana modal -->
                    <div class="modal" id=<?= 'modal-' . $dato['id'] ?>>
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Eliminar entrada</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    ¿Seguro que quieres borrar esta entrada?
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <form action="{{ url('entrada/' . $dato->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Aceptar</button>
                                        <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">Cancelar</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        <br>

        {{ $entradas->links() }}
    </div>

@endsection
