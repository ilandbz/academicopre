<?php

use App\Http\Controllers\AulaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CursoDocenteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\ProgramaController;
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
Route::get('usuarios-cambiar-estado', [UsuarioController::class, 'cambiarestado']);
Route::get('personas', [UsuarioController::class, 'personas']);
Route::get('personas-todos', [UsuarioController::class, 'listapersonas']);
Route::post('persona-eliminar', [UsuarioController::class, 'eliminarpersona']);

Route::get('docentes', [DocenteController::class, 'index'])->name('docentes');
Route::get('docentes-todos', [DocenteController::class, 'lista'])->name('docentes.todos');
Route::post('docentes-eliminar', [DocenteController::class, 'destroy'])->name('docentes.eliminar');
Route::get('docente-obtener', [DocenteController::class, 'obtenerdocente']);
Route::post('docentes', [DocenteController::class, 'store'])->name('docentes.store');

Route::get('programas', [ProgramaController::class, 'index'])->name('programas');
Route::get('programas-todos', [ProgramaController::class, 'lista'])->name('programas.todos');
Route::post('programas-eliminar', [ProgramaController::class, 'destroy'])->name('programas.eliminar');
Route::get('programas-obtener', [ProgramaController::class, 'obtenerprograma']);
Route::get('programas-cambiar-estado', [ProgramaController::class, 'cambiarestado']);
Route::post('programas', [ProgramaController::class, 'store'])->name('programas.store');

Route::get('aulas', [AulaController::class, 'index'])->name('aulas');
Route::get('aulas-todos', [AulaController::class, 'lista'])->name('aulas.todos');
Route::post('aulas-eliminar', [AulaController::class, 'destroy'])->name('aulas.eliminar');
Route::get('aula-obtener', [AulaController::class, 'show']);
Route::post('aulas', [AulaController::class, 'store'])->name('aulas.store');


Route::get('cursos', [CursoController::class, 'index'])->name('cursos');
Route::get('cursos-todos', [CursoController::class, 'lista'])->name('cursos.todos');
Route::post('cursos-eliminar', [CursoController::class, 'destroy'])->name('cursos.eliminar');
Route::get('curso-obtener', [CursoController::class, 'show']);
Route::post('cursos', [CursoController::class, 'store'])->name('cursos.store');


Route::get('asignacion', [CursoDocenteController::class, 'index']);
Route::get('asignacion-todos', [CursoDocenteController::class, 'lista']);
Route::post('asignacion-eliminar', [CursoDocenteController::class, 'destroy']);
Route::get('asignacion-obtener', [CursoDocenteController::class, 'show']);
Route::post('asignacion', [CursoDocenteController::class, 'store']);


Route::get('horario', [HorarioController::class, 'index']);
Route::get('horario-todos', [HorarioController::class, 'lista']);
Route::get('cursos-asignados-todos', [HorarioController::class, 'listacursosasignados']);
Route::post('horario-eliminar', [HorarioController::class, 'destroy']);
Route::get('obtener-horario', [HorarioController::class, 'show']);
Route::get('obtener-horarios', [HorarioController::class, 'Horarios']);
Route::post('horario', [HorarioController::class, 'store']);


Route::get('matricula', [MatriculaController::class, 'index']);
Route::post('matricula', [MatriculaController::class, 'store']);
Route::get('matricula-lista', [MatriculaController::class, 'lista']);
Route::post('matricula-eliminar', [MatriculaController::class, 'destroy']);
Route::get('matricula-obtener', [MatriculaController::class, 'show']);




Route::get('/', [HomeController::class, 'index'])->middleware('auth');