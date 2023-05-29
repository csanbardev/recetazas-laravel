@extends('layout/template')
@section('titulo', 'Recetazas | Añadir')

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

        <form action="{{ url('/create') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="titulo">Título
                <input name="titulo" class="form-control" type="text" value="{{ old('titulo') }}">
            </label>
            <br>
            <label for="descripcion">Descripción
                <textarea name="descripcion" class="form-control ckeditor" name="" id="descripcion" cols="30" rows="10">
        {{ old('descripcion') }}
      </textarea>
            </label>
            <br>
            <label for="fecha">Inserta la fecha
                <input name="fecha" class="form-control" type="date" id="" value="{{ old('fecha') }}">


            </label>
            <br>
            <label for="imagen">Inserta la imagen
                <input name="imagen" class="form-control" type="file" name="imagen" id="">
                @isset($parametros['errores']['imagen'])
                    <div class="alert alert-danger">{{ $parametros['errores']['imagen'] }}</div>
                @endisset
            </label>
            <br>
            <label for="pasos">
              <textarea class="form-control ckeditor" name="pasos" id="" cols="30" rows="10">

              </textarea>
            </label>

            <label for="categoria">
                <select name="categoria" id="" class="form-select">
                    <option value="{{ old('categoria') }}">Seleccionar categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <br>
            <input type="hidden" value="{{ auth()->user()->id }}" name="usuario">
            <input class="btn btn-primary" type="submit" name="submit">
        </form>
    </div>
    <script>
        CKEDITOR.replace('ckeditor', {
            height: '200px',
        });
    </script>
@endsection
