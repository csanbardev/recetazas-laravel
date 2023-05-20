@extends('layout/template')
@section('titulo', 'Recetazas | Editar')

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

        <form action="{{ url('entrada/' . $entrada->id . '/edit') }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <label for="titulo">Título
                <input name="titulo" class="form-control" type="text" value="{{ $entrada->titulo }}" />
            </label>
            <br>
            <label for="descripcion">Descripción
                <textarea name="descripcion" class="form-control" name="" id="descripcion" cols="30" rows="10">
        {{ $entrada->descripcion }}
      </textarea>
            </label>
            <br>
            <label for="fecha">Inserta la fecha
                <input name="fecha" class="form-control" type="date" id="" value="{{ $entrada->fecha }}">


            </label>
            <br>
            <label for="imagen">Inserta la imagen
                <input name="imagen" class="form-control" type="file" name="imagen" id=""
                    value="{{ $entrada->imagen }}">
            </label>
            <br>
            <label for="imagen">Imagen de la entrada
                <img src="{{ '/images/' . $entrada->imagen }}" width="200">
            </label>

            <br>


            <label for="categoria">Categoría
                <select name="categoria" id="" class="form-select">
                    <option value="">Seleccionar categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @if ($categoria->id == $entrada->categoria_id) {{ 'selected' }} @endif>
                            {{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <br>
            <input type="hidden" value="{{ $entrada->usuario_id }}" name="usuario">
            <input class="btn btn-primary" type="submit" name="submit">
        </form>
    </div>
    <script>
      CKEDITOR.replace('descripcion', {
        height: '500px',
      });
    </script>
@endsection
