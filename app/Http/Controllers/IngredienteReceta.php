<?php

namespace App\Http\Controllers;

use App\Models\Entradas;
use Illuminate\Support\Facades\DB;

use App\Models\Ingrediente;
use App\Models\IngredienteReceta as ModelsIngredienteReceta;
use Illuminate\Http\Request;

class IngredienteReceta extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Array $request, $idReceta)
    {
        /*
        - recibo el array con el ingrediente
        - obtengo el id del ingrediente a partir del nombre (si no hay, lo crea)
        - obtengo el id de la entrada a partir del ultimo id de entrada más 1
        - 
        */

        // obtengo el id del ingrediente
        $idIng = DB::select('select id from ingrediente where name = ?', [strtolower($request['nombre'])]);

        if($idIng == []){
            // TODO: esto hay que convertirlo en llamada al controlador y no al modelo
            dump($request);
            Ingrediente::create([
                'name' => strtolower($request['nombre']),
                'tipoCant' => strtolower($request['tipoCant'])
            ]);
            // y pillo la id
            $idIng = DB::select('select id from ingrediente where name = ? limit 1', [strtolower($request['nombre'])]);
        }

        // obtengo el id de la última entrada
        //$idReceta = Entradas::latest('id')->first();


        $ingredienteReceta = new ModelsIngredienteReceta();
        
        

        // inserto la cantidad
        $ingredienteReceta->cantidad = $request['cantidad'];
        $ingredienteReceta->ingrediente_id = $idIng[0]->id;
        $ingredienteReceta->entrada_id = $idReceta;
        
        $ingredienteReceta->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
