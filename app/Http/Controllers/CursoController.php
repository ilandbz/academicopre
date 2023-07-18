<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Cursos';
        $data['cursos'] = Curso::get();
        return view('paginas.cursos.inicio', $data);
    }


    public function lista(){
        $data['cursos'] = Curso::get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->id){
            $request->validate([
                'codigo'        => 'required|unique:cursos,codigo',
                'nombre'        => 'required|unique:cursos,nombre',
                'credito'       => 'required|numeric',
                'estado'        => 'required',
                'tipo'          => 'required',
                'estadodocente' => 'required'
            ], [
                'required'  => 'El campo es obligatorio.',
                'numeric'   => 'El campo debe ser numérico.',
                'unique'    => 'El valor ya existe'
            ]);
            $curso = Curso::create([
                'codigo'         => $request->codigo,
                'nombre'         => $request->nombre,
                'credito'        => $request->credito,
                'estado'         => $request->estado,
                'tipo'           => $request->tipo,
                'estadodocente'  => $request->estadodocente
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Curso Registrado satisfactoriamente'
            ],201);
        }else{
            $curso = Curso::where('id', $request->id)->first();
            $request->validate([
                'credito'       => 'required|numeric',
                'estado'        => 'required',
                'tipo'          => 'required',
                'estadodocente' => 'required',
                'codigo'       => [
                    'required',
                    Rule::unique('cursos')->ignore($request->id)
                ],
                'nombre'     => [
                    'required',
                    Rule::unique('cursos')->ignore($request->id)
                ]
            ], [
                'required'  => 'El campo es obligatorio.',
                'numeric'   => 'El campo debe ser numérico.',
                'unique'    => 'El valor ya existe'
            ]);
            
            $curso = Curso::where('id', $request->id)->update([
                'codigo'         => $request->codigo,
                'nombre'         => $request->nombre,
                'credito'        => $request->credito,
                'estado'         => $request->estado,
                'tipo'           => $request->tipo,
                'estadodocente'  => $request->estadodocente
            ]);


            return response()->json([
                'ok' => 1,
                'mensaje' => 'Curso Actualizado satisfactoriamente'
            ],201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request){
        $curso = Curso::where('id',$request->id)->first();
        return response()->json($curso, 200);
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
        $curso = Curso::where('id',$request->id)->first();
        $curso->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro de Curso Eliminado'
        ]);
    }
}
