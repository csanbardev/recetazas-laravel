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

 

    return redirect()->action([LogsController::class, 'index']);
  }


  public function pdf()
  {

    


    $logs = Logs::all();

    $pdf = Pdf::loadView('pdf.logs', compact('logs'));
    return $pdf->download('logs.pdf');
  }
}
