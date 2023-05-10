<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/entrada/{entradas}', [EntradasController::class, 'show'])->name('entradas.show');

Route::get('/create', [EntradasController::class, 'create'])->middleware('auth');
Route::post('/create', [EntradasController::class, 'store'])->middleware('auth');

Route::get('/entrada/{entradas}/edit', [EntradasController::class, 'edit'])->middleware('auth');
Route::put('/entrada/{entradas}/edit', [EntradasController::class, 'update'])->middleware('auth');
Route::delete('/entrada/{entradas}', [EntradasController::class, 'destroy'])->middleware('auth');

Route::resource('/user', UserController::class)
->middleware('auth');

Route::get('/admin', [AdminController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
