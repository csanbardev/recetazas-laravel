<?php

namespace App\Http\Controllers;

use App\Models\Entradas;
use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\User;

class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradas = Entradas::orderBy('fecha', 'desc')->paginate(6);
       

        return view('entradas.inicio')
        ->with('entradas', $entradas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    
    {
      $parametros = [
        "tituloventana" => "Recetazas | Últimas entradas",
        "datos" => null,
        "mensajes" => [],
        "paginacion" => null
      ];
      $categorias = Categorias::all();

        return view('entradas.create')
        ->with('parametros', $parametros)
        ->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
        'titulo' => 'required|max:15',
        'descripcion' => 'required|max:300',
        'fecha' => 'required|date',
        'imagen' => 'required',
        'categoria' => 'required',
        'usuario' => 'required'
      ]);

      $entrada = new Entradas();

      if($request->hasFile('imagen')){
        $file = $request->file('imagen');
        $destino = "images/";
        $nombreImagen = time().'-'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destino, $nombreImagen);

      }


      $entrada->titulo = $request->input('titulo');
      $entrada->descripcion = $request->input('descripcion');
      $entrada->fecha = $request->input('fecha');
      $entrada->imagen = $nombreImagen;
      $entrada->categoria_id = $request->input('categoria');
      $entrada->usuario_id = $request->input('usuario');
      

      $entrada->save(); //salva todo
      $mensaje = "Entrada añadida con éxito";
      return redirect()->action([EntradasController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entradas $entradas)
    {
      $usuario = User::find($entradas->usuario_id);
      $categoria = Categorias::find($entradas->categoria_id);

        return view('entradas.detalle', compact('entradas', 'usuario', 'categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $entrada = Entradas::find($id);
        $categorias = Categorias::all();

        return view('entradas.edit')
        ->with('entrada', $entrada)
        ->with('categorias', $categorias);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'titulo' => 'required|max:15',
        'descripcion' => 'required|max:300',
        'fecha' => 'required|date',
        'categoria' => 'required',
        'usuario' => 'required'
      ]);

      $entrada = Entradas::find($id);

      if($request->hasFile('imagen')){
        $file = $request->file('imagen');
        $destino = "images/";
        $nombreImagen = time().'-'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destino, $nombreImagen);

        // solo cambio la imagen si se ha cambiado
        $entrada->imagen = $nombreImagen;
      }


      $entrada->titulo = $request->input('titulo');
      $entrada->descripcion = $request->input('descripcion');
      $entrada->fecha = $request->input('fecha');
      $entrada->categoria_id = $request->input('categoria');
      $entrada->usuario_id = $request->input('usuario');
      

      $entrada->save(); //salva todo
      $mensaje = "Entrada añadida con éxito";
      return redirect()->action([UserController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entrada = Entradas::find($id);
        $entrada->delete();

        return redirect()->action([UserController::class, 'index']);
    }
}
