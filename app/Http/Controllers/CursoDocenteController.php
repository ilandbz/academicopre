<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\CursoDocente;
use App\Models\Docente;
use App\Models\Programa;
use App\Models\Semestre;
use Illuminate\Http\Request;

class CursoDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $data['title'] = 'Asignacion de Cursos';
        $data['docentes']=Docente::with('persona:id,nombres,apellidop,apellidom')->get();
        $data['programas']=Programa::get();
        $data['cursos']=Curso::get();
        $data['semestres']=Semestre::get();
        return view('paginas.cursodocente.inicio', $data);
    }

    public function lista(){
        $data['registros'] = CursoDocente::with(['docente.persona', 'semestre', 'curso:id,nombre', 'programa'])->get();
        return $data;
    }

    protected $fillable = ['docente_id','curso_id','programa_id', 'semestre_id'];

    public function store(Request $request)
    {
        if(!$request->id){
            $request->validate([
                'docente_id'    => 'required',
                'curso_id'      => 'required',
                'programa_id'   => 'required',
                'semestre_id'   => 'required'
            ], [
                'required'   => 'El campo es obligatorio.'
            ]);
            $registro = CursoDocente::create([
                'docente_id'      => $request->docente_id,
                'curso_id'        => $request->curso_id,
                'programa_id'     => $request->programa_id,
                'semestre_id'     => $request->semestre_id
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Registro Exitoso'
            ],201);
        }else{

            $request->validate([
                'docente_id'    => 'required',
                'curso_id'      => 'required',
                'programa_id'   => 'required',
                'semestre_id'   => 'required'
            ], [
                'required'   => 'El campo es obligatorio.'
            ]);

            CursoDocente::where('id', $request->id)->update([
                'docente_id'   => $request->docente_id,
                'curso_id'     => $request->curso_id,
                'programa_id'  => $request->programa_id,
                'semestre_id'  => $request->semestre_id
            ]);

            return response()->json([
                'ok' => 1,
                'mensaje' => 'Actualizado satisfactoriamente'
            ],201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request){
        $programa = CursoDocente::where('id',$request->id)->first();
        return response()->json($programa, 200);
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
    public function destroy(Request $request)
    {
        $cursodocente = CursoDocente::where('id',$request->id)->first();
        $cursodocente->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro Eliminado'
        ]);
    }
}
