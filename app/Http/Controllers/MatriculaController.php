<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Persona;
use App\Models\Programa;
use App\Models\Role;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Matricula';
        $data['semestres'] = Semestre::orderBy('id', 'desc')->take(10)->get();
        $data['programas'] = Programa::get();
        return view('paginas.matricula.inicio', $data);
    }

    public function lista(){
        $data['registros'] = Matricula::with(['alumno.persona:id,nombres,apellidop,apellidom,dni', 'usuario:id,email', 'programa:id,nombre', 'semestre:id,nombre'])->get();
        return $data;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(!$request->id){
            $request->validate([
                'fecha_hora'    => 'required|date_format:Y-m-d H:i:s',
                'usuario_id'    => 'required',
                'programa_id'   => 'required',
                'nombres'       => 'required',
                'semestre_id'   => 'required',
                'apellidop'     => 'required',
                'apellidom'     => 'required',
                'fnacimiento'   => 'required|date_format:Y-m-d',
                'dni'           => 'required|numeric|digits:8|unique:personas,dni',
                'email'         => 'required|email|unique:personas,email',
                'direccion'     => 'required',
                'celular'       => 'required',
                'sexo'          => 'required'

            ], [
                'fecha_hora.required'   => 'El campo fecha hora es requerido',
                'semestre_id.required'  => 'El campo Semestre es requerido',
                'fecha_hora.date_format' => 'El campo Fecha y Hora debe tener el formato Y-m-d H:i:s.',
                'usuario_id.required'=> 'El campo usuario hora es requerido',
                'nombres.required'   => 'El campo nombres es obligatorio.',
                'apellidos.required' => 'El campo apellidos es obligatorio.',
                'direccion.required' => 'El campo Direccion es obligatorio.',
                'dni.required'       => 'El campo DNI es obligatorio.',
                'dni.numeric'        => 'El campo DNI debe ser numérico.',
                'dni.digits'         => 'El campo DNI debe tener 8 dígitos.',
                'dni.unique'         => 'El DNI ya está en uso.',
                'email.required'     => 'El campo email es obligatorio.',
                'email.email'        => 'El campo email debe ser una dirección de correo válida.',
                'email.unique'       => 'El email ya está en uso.',
                'fnacimiento.date_format' => 'El campo Fecha de Nacimiento debe tener el formato Y-m-d.',
            ]);
            $persona = Persona::create([
                'dni'               => $request->dni,
                'nombres'           => $request->nombres,
                'apellidop'         => $request->apellidop,
                'apellidom'         => $request->apellidom,
                'email'             => $request->email,
                'direccion'         => $request->direccion,
                'celular'           => $request->celular,
                'sexo'              => $request->sexo,
            ]);
            
            $codigoGenerado = substr(str_replace(['-', ' ', ':'], '', $request->fecha_hora), -8).substr($request->dni,0,2);
            $alumno = Alumno::create([
                'codigo'           => $codigoGenerado,
                'persona_id'       => $persona->id,
                'programa_id'      => $request->programa_id,
                'estado'           => 'Matriculado'
            ]);
            $password = Hash::make($request->password);
            $usuario = User::create([ 
                'email'             => $request->email,
                'persona_id'        => $persona->id,
                'password'          => $password,
                'role_id'           => Role::where('nombre', 'Alumno')->value('id'),
            ]);
            $matricula = Matricula::create([ 
                'fecha_hora'       => $request->fecha_hora,
                'usuario_id'       => $request->usuario_id,
                'semestre_id'      => $request->semestre_id,
                'programa_id'      => $request->programa_id,
                'alumno_id'        => $alumno->id,
                'observacion'      => $request->programa_id,
                'pagomatricula'    => $request->estadoPago
            ]);

            return response()->json([
                'ok' => 1,
                'mensaje' => 'Matricula Registrado satisfactoriamente'
            ],201);
        }else{
            //en el caso se eliminara

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request){
        $matricula = Matricula::where('id',$request->id)->first();
        return response()->json($matricula, 200);
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
        $matricula = Matricula::where('id',$request->id)->first();
        $matricula->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro Eliminado'
        ]);
    }
}
