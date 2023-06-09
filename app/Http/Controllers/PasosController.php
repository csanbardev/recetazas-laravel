<?php

namespace App\Http\Controllers;

use App\Models\Pasos;
use Illuminate\Http\Request;

class PasosController extends Controller
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
    public function store(array $request, $idReceta, $imagen = null)
    {   
        $req = new Request();
        $req->replace($request);

        $req->validate([
            'secuencia' => 'required'
        ]);

        $paso = new Pasos();

        $nombreImagen = null;
        // controlo que haya una imagen
        if ($imagen != null) {
            $file = $imagen;
            $destino = "images/";
            $nombreImagen = time() . '-' . $imagen->getClientOriginalName();
            $uploadSuccess = $imagen->move($destino, $nombreImagen);
        }

        $paso->secuencia = $request['secuencia'];
        $paso->orden = $request['orden'];
        $paso->entrada_id = $idReceta;
        $paso->imagen = $nombreImagen;

        $paso->save();
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
