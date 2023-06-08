@extends('layout/template')
@section('titulo', 'Recetazas | Añadir')

@section('contenido')
    <div class="container text-center">

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
                <input name="titulo" class="form-control" type="text" value="{{ old('titulo') }}" required>
            </label>
            <br>
            <label for="subtitulo">Subtítulo
                <input name="subtitulo" class="form-control" type="text" value="{{ old('subtitulo') }}" required>
            </label>
            <br>
            <label for="descripcion">Descripción
                <textarea name="descripcion" class="form-control ckeditor" name="" id="descripcion" cols="30"
                    rows="10" required>
                    {{ old('descripcion') }}
                </textarea>
            </label>
            <br>
            <label for="descripcionbreve">Descripción breve
                <textarea name="descripcion_breve" class="form-control ckeditor" name="" id="descripcion_breve" cols="30"
                    rows="10" required>
                    {{ old('descripcion_breve') }}
                </textarea>
            </label>
            <br>
            <label for="fecha">Inserta la fecha
                <input name="fecha" class="form-control" type="date" id="" value="{{ old('fecha') }}" required>


            </label>
            <br>
            <label for="imagen">Inserta la imagen
                <input name="imagen" class="form-control" type="file" name="imagen" id="" required>
                @isset($parametros['errores']['imagen'])
                    <div class="alert alert-danger">{{ $parametros['errores']['imagen'] }}</div>
                @endisset
            </label>
            <br>


            <label for="categoria">Selecciona una categoría:
                <select name="categoria" id="" class="form-select" required>
                    <option value="{{ old('categoria') }}">Seleccionar categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </label>
            <br>

            <h3>Introduce los ingredientes:</h3>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th></th>
                        <th>Cantidad</th>
                        <th>Unidad de Medida</th>
                        <th>Ingrediente</th>
                    </tr>
                </thead>
                <tbody id="ingredientes">
                    @if (!isset(old('ing')[0]))
                        <tr id="ing-0">
                            <td>
                                <input type="checkbox" name="" id="" value="ing-0">
                            </td>
                            <td>
                                <input name="ing[0][cantidad]" type="text" placeholder="cantidad" required>
                            </td>
                            <td>
                                <input name="ing[0][tipoCant]" type="text" placeholder="unidad de medida" required>
                            </td>
                            <td>
                                <input name="ing[0][nombre]" type="text" placeholder="ingrediente" required>
                            </td>
                        </tr>
                    @else
                        @foreach (old('ing') as $ingre)
                            <tr id="ing-{{ $loop->index }}">
                                <td>
                                    <input type="checkbox" name="" id="" value="ing-{{ $loop->index }}">
                                </td>
                                <td>
                                    <input name="ing[{{ $loop->index }}][cantidad]" type="text" placeholder="cantidad"
                                        value="{{ $ingre['cantidad'] }}">
                                </td>
                                <td>
                                    <input name="ing[{{ $loop->index }}][tipoCant]" type="text"
                                        placeholder="unidad de medida" value="{{ $ingre['tipoCant'] }}">
                                </td>
                                <td>
                                    <input name="ing[{{ $loop->index }}][nombre]" type="text" placeholder="ingrediente"
                                        value="{{ $ingre['nombre'] }}">
                                </td>

                            </tr>
                        @endforeach

                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <button id="btn-add" class="btn btn-info">
                                Sumar
                            </button>
                            <button id="btn-delete-ing" class="btn btn-info">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <br>

            <h3>Introduce los pasos a seguir:</h3>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th></th>
                        <th>Descripción</th>
                        <th>Imagen (opcional)</th>
                    </tr>
                </thead>
                <tbody id="pasos">
                    @if (!isset(old('paso')[0]))
                        <tr id="pas-0">
                            <td>
                                <input type="checkbox" name="" id="" value="pas-0">

                            </td>
                            <td>
                                <textarea name="paso[0][secuencia]" id="" cols="60" rows="5"></textarea>
                                <input type="hidden" name="paso[0][orden]" value="1">
                            </td>
                            <td>
                                <input name="paso[0][imagen]" class="form-control" type="file"id="">
                            </td>
                        </tr>
                    @else
                        @foreach (old('paso') as $pas)
                            <tr id="pas-{{ $loop->index }}">
                                <td>
                                    <input type="checkbox" name="" id="" value="pas-{{ $loop->index }}">

                                </td>
                                <td>
                                    <textarea name="paso[{{ $loop->index }}][secuencia]" id="" cols="60" rows="5">{{ $pas['secuencia'] }}</textarea>
                                    <input type="hidden" name="paso[{{ $loop->index }}][orden]" value="{{ $pas['orden'] }}">
                                </td>
                                <td>
                                    <input name="paso[{{ $loop->index }}][imagen]" class="form-control" type="file"id="">
                                </td>
                            </tr>
                        @endforeach

                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <button id="btn-add-paso" class="btn btn-info">
                                Sumar
                            </button>
                            <button id="btn-delete-pas" class="btn btn-info">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </tfoot>
            </table>

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

    <script type="text/javascript" src="{{ asset('js/ingredientes.js') }}"></script>
@endsection
