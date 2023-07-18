<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\CursoDocente;
use App\Models\Horario;
use App\Models\Semestre;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Horario';
        $data['semestres'] = Semestre::orderBy('id','desc')->get();
        
        return view('paginas.horario.inicio', $data);
    }


    public function Horarios(Request $request){
        $data['curso']=Curso::select('id', 'nombre')->where('id', $request->id)->get();
        $data['horarios'] = Horario::where('curso_id', $request->id)->get();
        return $data;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->id){
            $request->validate([
                'curso_id'        => 'required',
                'dia'             => 'required',
                'horaingreso'     => 'required|date_format:H:i',
                'horasalida'      => 'required',
            ], [
                'required' => 'El campo es obligatorio.',
                'numeric'   => 'El campo debe ser numerico',
                'date_format'   => 'El dato no es reconocido como hora'
            ]);
            $horario = Horario::create([
                'curso_id'          => $request->curso_id,
                'dia'               => $request->dia,
                'horaingreso'       => $request->horaingreso,
                'horasalida'        => $request->horasalida,
                'observacion'       => $request->observacion
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Registrado satisfactoriamente'
            ],201);
        }else{
            $request->validate([
                'curso_id'        => 'required',
                'dia'             => 'required',
                'horaingreso'     => 'required|date_format:H:i',
                'horasalida'      => 'required'
            ], [
                'required' => 'El campo es obligatorio.',
                'numeric'   => 'El campo debe ser numerico',
                'date_format'   => 'El dato no es reconocido como hora'
            ]);
            
            $horario = Horario::where('id', $request->id)->update([
                'curso_id'          => $request->curso_id,
                'dia'               => $request->dia,
                'horaingreso'       => $request->horaingreso,
                'horasalida'        => $request->horasalida,
                'observacion'       => $request->observacion
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
    public function show(Request $request)
    {
        $horario = Horario::where('id',$request->id)->first();
        return response()->json($horario, 200);
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
    public function destroy(Request $request){
        $docente = Horario::where('id',$request->id)->first();
        $docente->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro Eliminado'
        ]);
    }
}
