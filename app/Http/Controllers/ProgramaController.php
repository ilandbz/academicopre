<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Programa;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $data['title'] = 'Programas de Estudio';
        $data['aulas'] = Aula::get();
        $data['semestres'] = Semestre::orderBy('id', 'desc')->get();
        return view('paginas.programas.inicio', $data);
    }


    public function lista(){
        $data['programas'] = Programa::with(['aula:id,nombre,seccion,aforo', 'semestre:id,nombre'])->get();
        return $data;
    }

    public function obtenerprograma(Request $request){
        $programa = Programa::with(['aula:id,nombre,seccion,aforo', 'semestre:id,nombre'])->where('id',$request->id)->first();
        return response()->json($programa, 200);
    }

    public function cambiarestado(Request $request){
        $programa = Programa::where('id', $request->id)->first();

        $programa->es_activo = ($programa->es_activo == 1) ? 0 : 1;
        
        $programa->save();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Cambiado de Estado'
        ],200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->id){
            $request->validate([
                'nombre'        => 'required|unique:programas,nombre',
                'aula_id'       => 'required',
                'vacantes'      => 'required|numeric',
                'semestre_id'   => 'required',
            ], [
                'required' => 'El campo es obligatorio.',
                'numeric'   => 'El campo debe ser numerico'
            ]);
            $programa = Programa::create([
                'nombre'               => $request->nombre,
                'aula_id'           => $request->aula_id,
                'vacantes'         => $request->vacantes,
                'semestre_id'         => $request->semestre_id
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Programa Registrado satisfactoriamente'
            ],201);
        }else{
            $programa = Programa::where('id', $request->id)->first();
            $request->validate([
                'aula_id'       => 'required',
                'vacantes'      => 'required|numeric',
                'semestre_id'   => 'required',
                'nombre'       => [
                    'required',
                    Rule::unique('programas')->ignore($request->id)
                ]
            ], [
                'nombres.required'   => 'El campo nombre es obligatorio.',
                'required'           => 'El campo es obligatorio.',
                'unique'         => 'El nombre ya está en uso.'
            ]);
            
            $programa = Programa::where('id', $request->id)->update([
                'nombre'               => $request->nombre,
                'aula_id'           => $request->aula_id,
                'vacantes'         => $request->vacantes,
                'semestre_id'         => $request->semestre_id
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Programa Actualizado satisfactoriamente'
            ],201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function destroy(Request $request)
    {
        $docente = Programa::where('id',$request->id)->first();
        $docente->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro de Docente Eliminado'
        ]);
    }
}
