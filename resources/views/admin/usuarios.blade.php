@extends('layout/template')
@section('titulo', 'Recetazas | Admin Usuarios')

@section('contenido')
  <div class="container">
    <h2>Listado de usuarios</h2>
    <form class="form-inline" action="{{url('admin/users')}}" method="POST">
    @csrf
    
      <input class="form-control mr-sm-2" name="name" type="text" placeholder="Buscar usuario">
      <button class="btn btn-success" type="submit">Buscar usuario</button>
    </form>
    @if (count($usuarios)<=0) 
      <h2>No hay usuarios para mostrar :C</h2>
    @endif
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nick</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Email</th>
          <th>Avatar</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($usuarios as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->nick}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->apellidos}}</td>
            <td>{{$user->email}}</td>
            <td><img src="{{'/images/'.$user->avatar}}" >{{$user->avatar}}</td>
            <td>
              <a href="{{ url('user/' . $user->id . '/edit') }}" class="btn btn-secondary">Editar</a>
              @if($user->id!=auth()->user()->id) 
              <a class="btn btn-danger" data-toggle="modal"
                                    data-target=<?= '#modal-' . $user['id'] ?>>Eliminar</a>
              @endif                      
            </td>
          </tr>
          <!-- Ventana modal -->
          <div class="modal" id=<?= 'modal-' . $user['id'] ?>>
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar usuario</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        ¿Seguro que quieres borrar este usuario?
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <form action="{{ url('user/' . $user->id) }}" method="post">
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
    {{ $usuarios->links() }}
  </div>
@endsection