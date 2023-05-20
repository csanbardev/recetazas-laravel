<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LogsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $logs = Logs::orderBy('fecha', 'desc')->paginate(6);

    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'listar logs',
      auth()->user()->name
    ];
    $log->create($params);

    return view('admin.logs')
      ->with('logs', $logs);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(array $params)
  {
    DB::select('CALL insertarLog(?,?,?,?)', $params);
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $log = Logs::find($id);
    $log->delete();

    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'eliminar log',
      auth()->user()->name
    ];
    $log->create($params);

    return redirect()->action([LogsController::class, 'index']);
  }


  public function pdf()
  {

    $log = new LogsController;
    $params = [
      date('y-m-d'),
      date('H:i:s'),
      'imprimir logs',
      auth()->user()->name
    ];
    $log->create($params);


    $logs = Logs::all();

    $pdf = Pdf::loadView('pdf.logs', compact('logs'));
    return $pdf->download('logs.pdf');
  }
}
