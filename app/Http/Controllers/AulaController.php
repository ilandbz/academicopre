<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Aulas';
        return view('paginas.aulas.inicio', $data);
    }

    public function lista(){
        $data['aulas'] = Aula::get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->id){
            $request->validate([
                'nombre'        => 'required|unique:programas,nombre',
                'piso'          => 'required',
                'numero'        => 'required|numeric',
                'aforo'         => 'required|numeric',
                'seccion'       => 'required'
            ], [
                'required'       => 'El campo es obligatorio.',
                'numeric'        => 'El campo debe ser numerico',
                'nombre.unique'  => 'El nombre ya está en uso.',
            ]);
            $aula = Aula::create([
                'nombre'          => $request->nombre,
                'piso'            => $request->piso,
                'numero'          => $request->numero,
                'aforo'           => $request->aforo,
                'seccion'         => $request->seccion,
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Aula Registrado satisfactoriamente'
            ],201);
        }else{
            $aula = Aula::where('id', $request->id)->first();
            $request->validate([
                'piso'       => 'required',
                'numero'      => 'required|numeric',
                'aforo'   => 'required|numeric',
                'nombre'       => [
                    'required',
                    Rule::unique('aulas')->ignore($request->id)
                ]
            ], [
                'nombre.required'   => 'El campo nombre es obligatorio.',
                'required'           => 'El campo es obligatorio.',
                'unique'         => 'El nombre ya está en uso.'
            ]);
            
            $aula = Aula::where('id', $request->id)->update([
                'nombre'          => $request->nombre,
                'piso'            => $request->piso,
                'numero'          => $request->numero,
                'aforo'           => $request->aforo,
                'seccion'         => $request->seccion
            ]);

            return response()->json([
                'ok' => 1,
                'mensaje' => 'Aula Actualizado satisfactoriamente'
            ],201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $aula = Aula::where('id',$request->id)->first();
        return response()->json($aula, 200);
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
        $docente = Aula::where('id',$request->id)->first();
        $docente->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro de Aula Eliminado'
        ]);
    }
}
