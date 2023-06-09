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
use Barryvdh\Debugbar\Facades\Debugbar as FacadesDebugbar;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
    $errores = [];

    $request->validate([
      'titulo' => 'required|max:30',
      'subtitulo' => 'required|max:60',
      'descripcion' => 'required|max:300',
      'descripcion_breve' => 'required|max:120',
      'fecha' => 'required|date',
      'categoria' => 'required',
      'usuario' => 'required'
    ]);


    $pasosTabla = $request->input('paso'); // tomo los pasos
    $ingredientes = $request->input('ing'); // tomo los ingredientes

    if($pasosTabla == null){
      throw ValidationException::withMessages(["Inserta al menos un paso"]);

    }

    if($ingredientes == null){
      throw ValidationException::withMessages(["Inserta al menos un ingrediente"]);

    }

    // valido los ingredientes
    foreach ($ingredientes as $ingre) {


      if (!is_numeric($ingre['cantidad'])) {
        $errores['cantidad'] = "La cantidad debe ser un número";
      }

      if (strlen($ingre['nombre']) > 20) {
        $errores['nombre'] = "El nombre del ingrediente es demasiado largo";
      }

      if (strlen($ingre['tipoCant']) > 6) {
        $errores['nombre'] = "El tipo de cantidad es demasiado larga";
      }
    }

    // valido los pasos
    foreach ($pasosTabla as $paso) {

      if ($paso['secuencia'] == "") {
        $errores['secuencia'] = "Los pasos deben tener una descripción";
      }

      if (strlen($paso['secuencia']) > 150) {
        $errores['secuencia'] = "La descripcion del paso es muy larga";
      }
    }

    // si hay errores, lanzo la excepción
    if (count($errores) > 0) {
      throw ValidationException::withMessages($errores);
    }

    $entrada = new Entradas();

    if ($request->hasFile('imagen')) {
      $file = $request->file('imagen');
      $destino = "imagen/";
      $nombreImagen = time() . '-' . $file->getClientOriginalName();
      $uploadSuccess = $request->file('imagen')->move($destino, $nombreImagen);
    }


    $entrada->titulo = $request->input('titulo');
    $entrada->descripcion = $request->input('descripcion');
    $entrada->fecha = $request->input('fecha');
    $entrada->imagen = "none.jpg";
    $entrada->categoria_id = $request->input('categoria');
    $entrada->usuario_id = $request->input('usuario');
    $entrada->subtitulo = $request->input('subtitulo');
    $entrada->descripcion_breve = $request->input('descripcion_breve');
    $entrada->save(); //salva todo

    // ahora inserto los pasos de la receta
    $pasos = new PasosController();


    foreach($pasosTabla as $key=>$pas){
      if(isset($request->file('paso')[$key])){
        $pasos->store($pas, $entrada->id, $request->file('paso')[$key]['imagen']);

      }
      $pasos->store($pas, $entrada->id);

    }


    // ahora inserto los ingredientes de la receta
    $ingredientesReceta = new ControllersIngredienteReceta;

    foreach ($ingredientes as $ing) {
      $ingredientesReceta->store($ing, $entrada->id);
    }

    

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
      ->join('ingrediente', 'ingrediente_receta.ingrediente_id', '=', 'ingrediente.id')
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

  public function pdf()
  {
    $entradas = Entradas::all();

    $pdf = Pdf::loadView('pdf.entradas', compact('entradas'));
    return $pdf->download('entradas.pdf');
  }
}
