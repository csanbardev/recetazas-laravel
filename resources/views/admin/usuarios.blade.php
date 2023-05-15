@extends('layout/template')
@section('titulo', 'Recetazas | Usuarios')

@section('contenido')
  <div class="container">
    <h2>Listado de usuarios</h2>
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
              <a href="{{ url('user/' . $user->id) }}" class="btn btn-secondary">Eliminar</a> 
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection