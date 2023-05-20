<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('titulo')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
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
  </div>
