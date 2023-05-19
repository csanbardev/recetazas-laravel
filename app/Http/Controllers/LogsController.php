<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;
use Illuminate\Support\Facades\DB;

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
