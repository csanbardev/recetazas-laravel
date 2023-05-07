<?php

namespace App\Http\Controllers;

use App\Models\Entradas;
use Illuminate\Http\Request;
use App\Models\Categorias;

class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradas = Entradas::all();
        $parametros = [
          "tituloventana" => "Recetazas | Últimas entradas",
          "datos" => $entradas,
          "mensajes" => [],
          "paginacion" => null
        ];

        return view('entradas.inicio')
        ->with('parametros', $parametros);
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
        'imagen' => 'required|max:20',
        'categoria' => 'required',
        'usuario' => 'required'
      ]);

      $entrada = new Entradas();
      $entrada->titulo = $request->input('titulo');
      $entrada->descripcion = $request->input('descripcion');
      $entrada->fecha = $request->input('fecha');
      $entrada->imagen = "imagen";
      $entrada->categoria_id = $request->input('categoria');
      $entrada->usuario_id = $request->input('usuario');
      

      $entrada->save(); //salva todo
      $mensaje = "Entrada añadida con éxito";
      return view('entradas.mensaje')
      ->with('mensaje', $mensaje);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entradas $entradas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entradas $entradas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entradas $entradas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entradas $entradas)
    {
        //
    }
}
