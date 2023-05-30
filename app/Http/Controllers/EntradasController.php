<?php

namespace App\Http\Controllers;

use App\Http\Controllers\IngredienteReceta as ControllersIngredienteReceta;
use Illuminate\Support\Facades\DB;
use App\Models\Entradas;
use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\User;
use App\Models\Pasos;
use App\Models\Ingrediente;
use App\Models\IngredienteReceta;

use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

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
   * Display a listing of the resource.
   */
  public function indexBusc(Request $request)
  {

    $search = $request->input('name');
    $entradas = Entradas::where('titulo', 'LIKE', '%' . $search . '%')->orderBy('fecha', 'desc')->paginate(6);


    return view('entradas.inicio')
      ->with('entradas', $entradas);
  }

  /**
   * Display a listing of the resource.
   */
  public function indexAsc()
  {


    $entradas = Entradas::orderBy('fecha', 'asc')->paginate(6);

    

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

    if ($request->hasFile('imagen')) {
      $file = $request->file('imagen');
      $destino = "images/";
      $nombreImagen = time() . '-' . $file->getClientOriginalName();
      $uploadSuccess = $request->file('imagen')->move($destino, $nombreImagen);
    }


    $entrada->titulo = $request->input('titulo');
    $entrada->descripcion = $request->input('descripcion');
    $entrada->fecha = $request->input('fecha');
    $entrada->imagen = $nombreImagen;
    $entrada->categoria_id = $request->input('categoria');
    $entrada->usuario_id = $request->input('usuario');


    $entrada->save(); //salva todo

    // ahora inserto los pasos de la receta
    $pasos = new PasosController();
    $pasosTabla = $request->input('paso');
    foreach($pasosTabla as $pas){
      $pasos->store($pas, $entrada->id);
    }

    // ahora inserto los ingredientes de la receta
    $ingredientesReceta = new ControllersIngredienteReceta;
    $ingredientes = $request->input('ing');

    foreach($ingredientes as $ing){
     $ingredientesReceta->store($ing, $entrada->id);
    }

    // hago el log
    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'crear entrada',
      auth()->user()->name
    ];
    $log->create($params);

    return redirect()->action([EntradasController::class, 'index']);
  }

  /**
   * Display the specified resource.
   */
  public function show(Entradas $entradas)
  {
    $usuario = User::find($entradas->usuario_id);
    $categoria = Categorias::find($entradas->categoria_id);
    $pasos = Pasos::where('entrada_id', '=', $entradas->id)->orderBy('orden', 'asc')->get();
    $ingredientes = DB::table('ingrediente_receta')
                      ->join('ingrediente', 'ingrediente_receta.ingrediente_id', '=','ingrediente.id')
                      ->where('ingrediente_receta.entrada_id', '=', $entradas->id)
                      ->get();

    
    

    return view('entradas.detalle', compact('entradas', 'usuario', 'categoria', 'pasos', 'ingredientes'));
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

    if ($request->hasFile('imagen')) {
      $file = $request->file('imagen');
      $destino = "images/";
      $nombreImagen = time() . '-' . $file->getClientOriginalName();
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
    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'actualizar entrada',
      auth()->user()->name
    ];
    $log->create($params);
    return redirect()->action([UserController::class, 'index']);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'eliminar entrada',
      auth()->user()->name
    ];
    $log->create($params);

    $entrada = Entradas::find($id);
    $entrada->delete();

    return redirect()->action([UserController::class, 'index']);
  }

  public function pdf()
  {
    $entradas = Entradas::all();

    $pdf = Pdf::loadView('pdf.entradas', compact('entradas'));
    return $pdf->download('entradas.pdf');
  }
}
