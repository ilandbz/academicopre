<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Persona;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Docentes';
        $data['docentes'] = Docente::get();
        return view('paginas.docentes.index', $data);
    }
    public function cargarvistatabla(){
        $data['docentes'] = Docente::get();
        $html = view('paginas.docentes.vistatabla', $data)->render();
        return response()->json([
            'vista' => $html
        ], 200);
    }

    public function lista(){
        $data['docentes'] = Docente::with('persona:id,nombres,sexo,apellidop,apellidom,dni')->get();
        return $data;
    }

    public function obtenerdocente(Request $request){
        $docente = Docente::with('persona:id,nombres,apellidop,apellidom,dni,sexo,email')->where('id',$request->id)->first();
        return response()->json($docente, 200);
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
        if(!$request->id){
            $request->validate([
                'nombres'   => 'required',
                'apellidop' => 'required',
                'apellidom' => 'required',
                'dni'       => 'required|numeric|digits:8|unique:personas,dni',
                'email'     => 'required|email|unique:personas,email',
                'password'              => 'required',
                'password_confirmation' => 'required|same:password'
            ], [
                'nombres.required'   => 'El campo nombres es obligatorio.',
                'apellidos.required' => 'El campo apellidos es obligatorio.',
                'dni.required'       => 'El campo DNI es obligatorio.',
                'dni.numeric'        => 'El campo DNI debe ser numérico.',
                'dni.digits'         => 'El campo DNI debe tener 8 dígitos.',
                'dni.unique'         => 'El DNI ya está en uso.',
                'email.required'     => 'El campo email es obligatorio.',
                'email.email'        => 'El campo email debe ser una dirección de correo válida.',
                'email.unique'       => 'El email ya está en uso.',
                'password.required'         => 'El campo contraseña es obligatorio.',
                'password_confirmation.required' => 'El campo confirmar contraseña es obligatorio.',
                'password_confirmation.same' => 'La confirmación de contraseña no coincide con la contraseña.'
            ]);
            $password = Hash::make($request->password);
            $persona = Persona::create([
                'dni'               => $request->dni,
                'nombres'           => $request->nombres,
                'apellidop'         => $request->apellidop,
                'apellidom'         => $request->apellidom,
                'email'             => $request->email,
            ]);
            $docente = Docente::create([
                'persona_id'        => $persona->id,
                'tipocontrato'      => $request->tipocontrato
            ]);
            $usuario = User::create([ 
                'email'             => $request->email,
                'persona_id'        => $persona->id,
                'password'          => $password,
                'role_id'           => Role::where('nombre', 'Maestro')->value('id'),
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Docente Registrado satisfactoriamente'
            ],201);
        }else{
            $docente = Docente::with('persona:id,nombres,apellidop,apellidom,dni,sexo,email')->where('id', $request->id)->first();
            $request->validate([
                'nombres'   => 'required',
                'apellidop' => 'required',
                'apellidom' => 'required',
                'dni'       => [
                    'required',
                    'numeric',
                    'digits:8',
                    Rule::unique('personas')->ignore($docente->persona_id)
                ],
                'email'     => [
                    'required',
                    'email',
                    Rule::unique('personas')->ignore($docente->persona_id)
                ]
            ], [
                'nombres.required'   => 'El campo nombres es obligatorio.',
                'required'           => 'El campo es obligatorio.',
                'dni.required'       => 'El campo DNI es obligatorio.',
                'dni.numeric'        => 'El campo DNI debe ser numérico.',
                'dni.digits'         => 'El campo DNI debe tener 8 dígitos.',
                'dni.unique'         => 'El DNI ya está en uso.',
                'email.required'     => 'El campo email es obligatorio.',
                'email.email'        => 'El campo email debe ser una dirección de correo válida.',
                'email.unique'       => 'El email ya está en uso.'
            ]);
            
            $docente->tipocontrato = $request->tipocontrato;
            $docente->save();

            $persona = Persona::where('id', $docente->persona_id)->update([
                'dni'               => $request->dni,
                'nombres'           => $request->nombres,
                'apellidop'         => $request->apellidop,
                'apellidom'         => $request->apellidom,
                'email'             => $request->email,
            ]);

            return response()->json([
                'ok' => 1,
                'mensaje' => 'Docente Actualizado satisfactoriamente'
            ],201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request){

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
