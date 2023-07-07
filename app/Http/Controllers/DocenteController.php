<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['content'] = 'paginas.docentes.inicio';
        $data['docentes'] = Docente::get();
        return view('paginas.docentes.index', $data);
    }
    public function cargarvistatabla(){
        $data['docentes'] = Docente::get();
        return view('paginas.docentes.vistatabla', $data);
    }

    public function lista(){
        $data['docentes'] = Docente::get();
        return $data;
    }


    public function create(){
        $data['content'] = 'paginas.nuevodocente';
        $data['usuarios'] = User::get();
        return view('app', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres'   => 'required',
            'apellidos' => 'required',
            'dni'       => 'required|numeric|digits:8'
        ], [
            'nombres.required'   => 'El campo nombres es obligatorio.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'dni.required'       => 'El campo DNI es obligatorio.',
            'dni.numeric'        => 'El campo DNI debe ser numérico.',
            'dni.digits'         => 'El campo DNI debe tener 8 dígitos.'
        ]);
        $docente = Docente::create([
            'nombres'           => $request->nombres,
            'apellidos'         => $request->apellidos,
            'dni'               => $request->dni,
            'password'          => $request->password,
            'sexo'              => $request->sexo,
            'tipocontrato'      => $request->tipocontrato
        ]);
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Docente Registrado satisfactoriamente'
        ],201);
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
        $docente = Docente::where('id',$request->id)->first();
        $docente->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro de Docente Eliminado'
        ]);
    }
}
