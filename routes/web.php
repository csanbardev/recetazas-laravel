<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EntradasController::class, 'index']);

Route::get('/entrada/{entradas}', [EntradasController::class, 'show'])->name('entradas.show')->middleware('can:user');

Route::get('/create', [EntradasController::class, 'create'])->middleware('auth')->middleware('can:user');
Route::post('/create', [EntradasController::class, 'store'])->middleware('auth')->middleware('can:user');

Route::get('/entrada/{entradas}/edit', [EntradasController::class, 'edit'])->middleware('auth')->middleware('can:user');
Route::put('/entrada/{entradas}/edit', [EntradasController::class, 'update'])->middleware('auth')->middleware('can:user');
Route::delete('/entrada/{entradas}', [EntradasController::class, 'destroy'])->middleware('auth')->middleware('can:user');

Route::get('/user', [UserController::class, 'index'])
->middleware('auth')->middleware('can:user');

Route::get('/user/{user}/edit', [UserController::class, 'edit'])->middleware('auth')->middleware('can:admin');
Route::get('/admin/entradas', [AdminController::class, 'index'])->name('admin.entradas')->middleware('auth')->middleware('can:admin');
Route::get('/admin/users', [AdminController::class, 'usuarios'])->name('admin.usuarios')->middleware('auth')->middleware('can:admin');
Route::get('/admin/logs', [LogsController::class, 'index'])->name('admin.logs')->middleware('auth')->middleware('can:admin');

Route::get('/user/{usuario}/edit', [UserController::class, 'edit'])->middleware('auth')->middleware('can:admin');
Route::put('/user/{usuario}/edit', [UserController::class, 'update'])->middleware('auth')->middleware('can:admin');
Route::delete('/user/{usuario}', [UserController::class, 'destroy'])->middleware('auth')->middleware('can:admin');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
