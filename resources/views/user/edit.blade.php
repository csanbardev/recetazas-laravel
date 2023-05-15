@extends('layout/template')
@section('titulo', 'Recetazas | Editar usuario')

@section('contenido')
    <div class="container center">

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('user/' . $user->id.'/edit') }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <label for="titulo">Nick
                <input name="nick" class="form-control" type="text" value="{{ $user->nick }}" />
            </label>
            <br>
            <label for="titulo">Nombre
                <input name="name" class="form-control" type="text" value="{{ $user->name }}" />
            </label>
            <br>
            <label for="titulo">Apellidos
                <input name="apellidos" class="form-control" type="text" value="{{ $user->apellidos }}" />
            </label>
            <br>
            <label for="titulo">Email
                <input name="email" class="form-control" type="text" value="{{ $user->email }}" />
            </label>
            <br>
           
        
          
            <input class="btn btn-primary" type="submit" name="submit">
        </form>
        
    </div>
@endsection
