<?php

use App\Http\Controllers\DocenteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
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

// Route::get('/', function () {
//     return view('app');
// });

// Route::get('login', function(){
//     return view('login');
// })->name('login');

Route::get('login', function () {
    return view('login');
})->name('login');

// Route::get('usuarios', [])
Route::post('login', [LoginController::class, 'autenticar'])->name('acceder');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios');
Route::get('usuarios-todos', [UsuarioController::class, 'lista']);
Route::post('usuarios', [UsuarioController::class, 'store']);
Route::post('usuarios-eliminar', [UsuarioController::class, 'destroy']);
Route::get('usuarios-obtener', [UsuarioController::class, 'obtenerusuario']);
Route::post('usuario-resetear', [UsuarioController::class, 'resetearusuario']);
Route::get('personas', [UsuarioController::class, 'personas']);
Route::get('personas-todos', [UsuarioController::class, 'listapersonas']);
Route::post('persona-eliminar', [UsuarioController::class, 'eliminarpersona']);


Route::get('docentes', [DocenteController::class, 'index'])->name('docentes');
Route::get('docentes-todos', [DocenteController::class, 'lista'])->name('docentes.todos');
Route::post('docentes-eliminar', [DocenteController::class, 'destroy'])->name('docentes.eliminar');
Route::get('docente-obtener', [DocenteController::class, 'obtenerdocente']);
Route::post('docentes', [DocenteController::class, 'store'])->name('docentes.store');


Route::get('/', [HomeController::class, 'index'])->middleware('auth');