<?php

namespace App\Http\Controllers;

use App\Models\Entradas;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $entradas = Entradas::orderBy('fecha', 'desc')->paginate(6);
        
      return view('user.entradas')
      ->with('entradas', $entradas);
    }

    /**
     * Muestra una lista de usuarios
     */
    public function usuarios(){
      $usuarios = User::orderBy('id', 'asc')->paginate(4);
       

      return view('admin.usuarios')
      ->with('usuarios', $usuarios);;
    }

    /**
     * Muestra una lista de logs
     */
    public function logs(){
      $logs = User::orderBy('id', 'asc')->paginate(10);
       

      return view('admin.logs')
      ->with('logs', $logs);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
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
