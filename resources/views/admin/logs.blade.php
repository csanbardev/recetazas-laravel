@extends('layout/template')
@section('titulo', 'Recetazas | Admin Logs')

@section('contenido')
<div class="container">
<h2>Listado de logs</h2>
    
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Usuario</th>
          <th>Acción</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($logs as $log)
          <tr>
            <td>{{$log->id}}</td>
            <td>{{$log->fecha}}</td>
            <td>{{$log->hora}}</td>
            <td>{{$log->usuario}}</td>
            <td>{{$log->operacion}}</td>
            <td>
              <a class="btn btn-danger" data-toggle="modal"
                                    data-target=<?= '#modal-' . $log['id'] ?>>Eliminar</a>                    
            </td>
          </tr>
          <!-- Ventana modal -->
          <div class="modal" id=<?= 'modal-' . $log['id'] ?>>
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar log</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        ¿Seguro que quieres borrar este registro?
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <form action="{{ url('logs/' . $log->id) }}" method="post">
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
      </tbody>
    </table>
    @if (count($logs)<=0) 
      <h2>No hay logs para mostrar :C</h2>
    @endif
    {{ $logs->links() }}
    <br>
    <br>
    <a href="{{url('/logs/imprimir')}}" class="btn btn-primary">Imprimir logs</a>
  </div>
@endsection