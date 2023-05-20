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
  public function usuarios()
  {
    $usuarios = User::orderBy('id', 'asc')->paginate(4);

    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'mostrar usuarios',
      auth()->user()->name
    ];
    $log->create($params);

    return view('admin.usuarios')
      ->with('usuarios', $usuarios);;
  }



  

}
