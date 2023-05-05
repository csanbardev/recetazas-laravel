@extends('layout/template')
@section('titulo', 'Recetazas | Añadir')

@section('contenido')
    <div class="container center">
      @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif

        <form action="{{url('/')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="titulo">Título
                <input name="txttitulo" class="form-control" type="text" value="{{old('titulo')}}">
            </label>
            <br>
            <label for="descripcion">Descripción
                <textarea name="txtdescripcion" class="form-control" name="" id="txtdescripcion" cols="30" rows="10">
        {{old('descripcion')}}
      </textarea>
            </label>
            <br>
            <label for="fecha">Inserta la fecha
                <input name="dtfecha" class="form-control" type="date" name="dtfecha" id="" value="{{old('fecha')}}">
                

            </label>
            <br>
            <label for="imagen">Inserta la imagen
                <input name="imagen" class="form-control" type="file" name="imagen" id="">
                @isset($parametros['errores']['imagen']) <div class="alert alert-danger">{{$parametros['errores']['imagen']}}</div>@endisset
            </label>
            <br>
            
            <label for="categoria">
              <select name="categoria" id="" class="form-select">
                <option value="{{old('categoria')}}">Seleccionar categoría</option>
                @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endforeach
              </select>
            </label>
            <br>
            <br>
            <input class="btn btn-primary" type="submit" name="submit">
        </form>
    </div>
@endsection
