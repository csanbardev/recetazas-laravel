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
    $entradas = Entradas::where('usuario_id', auth()->user()->id)->latest('fecha')->paginate(6);

    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'ver entradas user',
      auth()->user()->name
    ];
    $log->create($params);

    return view('user.entradas')
      ->with('entradas', $entradas);
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
  public function edit($id)
  {
    $user = User::find($id);


    return view('user.edit')
      ->with('user', $user);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {


    $user = User::find($id);




    $user->nick = $request->input('nick');
    $user->name = $request->input('name');
    $user->apellidos = $request->input('apellidos');
    $user->email = $request->input('email');


    $user->save(); //salva todo
    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'actualizar usuario',
      auth()->user()->name
    ];
    $log->create($params);

    return redirect()->action([AdminController::class, 'usuarios']);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $user =  User::find($id);
    $user->delete();

    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'eliminar usuario',
      auth()->user()->name
    ];
    $log->create($params);

    return redirect()->action([AdminController::class, 'usuarios']);
  }
}
