<?php

namespace App\Http\Controllers;
use App\Models\Entradas;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{   
    protected $paginationTheme = "bootstrap";
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradas = Entradas::where('usuario_id',auth()->user()->id)->latest('fecha')->paginate(6);
        
        return view('user.entradas')
        ->with('entradas', $entradas);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::where('id', $id);

        return $usuario;
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