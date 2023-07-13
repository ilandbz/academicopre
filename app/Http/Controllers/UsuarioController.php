<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['roles'] = Role::get();
        // $data['roles'] = Role::whereNotIn('nombre', ['Maestro', 'Alumno'])->get();
        $data['title'] = 'Usuarios';
        return view('paginas.usuarios.inicio', $data);
    }

    public function personas(){
        $data['title'] = 'Personas';
        return view('paginas.personas.inicio', $data);
    }

    public function lista(){
        $data['usuarios'] = User::with(['role:id,nombre', 'persona:id,nombres,apellidop,apellidom,dni'])->get();
        return $data;
    }

    public function listapersonas(){
        $data['personas'] = Persona::get();
        return $data;
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $password = Hash::make($request->password);
        if(!$request->id){
            $request->validate([
                'nombres'   => 'required',
                'apellidop' => 'required',
                'apellidom' => 'required',
                'dni'       => 'required|numeric|digits:8|unique:personas,dni',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required',
                'password_confirmation' => 'required|same:password'
            ], [
                'required'   => 'El campo es obligatorio.',
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
            $persona = Persona::create([
                'dni'               => $request->dni,
                'nombres'           => $request->nombres,
                'apellidop'         => $request->apellidop,
                'apellidom'         => $request->apellidom,
                'email'             => $request->email,
            ]);
            $usuario = User::create([ 
                'email'             => $request->email,
                'persona_id'        => $persona->id,
                'password'          => $password,
                'role_id'           => $request->role_id
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Usuario Registrado satisfactoriamente'
            ],201);
        }else{
            $usuario = User::where('id', $request->id)->first();
            $request->validate([
                'nombres'   => 'required',
                'apellidop' => 'required',
                'apellidom' => 'required',
                'dni'       => [
                    'required',
                    'numeric',
                    'digits:8',
                    Rule::unique('personas')->ignore($usuario->persona_id)
                ],
                'email'     => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($request->id)
                ]
            ], [
                'required'           => 'El campo es obligatorio.',
                'dni.required'       => 'El campo DNI es obligatorio.',
                'dni.numeric'        => 'El campo DNI debe ser numérico.',
                'dni.digits'         => 'El campo DNI debe tener 8 dígitos.',
                'dni.unique'         => 'El DNI ya está en uso.',
                'email.required'     => 'El campo email es obligatorio.',
                'email.email'        => 'El campo email debe ser una dirección de correo válida.',
                'email.unique'       => 'El email ya está en uso.'
            ]);

            $persona = Persona::where('id', $usuario->persona_id)->update([
                'dni'               => $request->dni,
                'nombres'           => $request->nombres,
                'apellidop'         => $request->apellidop,
                'apellidom'         => $request->apellidom,
                'email'             => $request->email,
            ]);
            $usuario = User::where('id', $request->id)->update([ 
                'email'             => $request->email,
                'role_id'           => $request->role_id
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Usuario Actualizado satisfactoriamente'
            ],201);
        }
    }
    public function resetearusuario(Request $request){
        $user = User::with('persona:id,dni')->where('id', $request->id)->first();
        $user->password = Hash::make($user->persona->dni);

        $user->save();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Clave Reseteado con Exito (su dni)'
        ],200);
    }
    public function obtenerusuario(Request $request){
        $usuario = User::with(['persona:id,dni,apellidop,apellidom,nombres', 'role:id,nombre'])->where('id',$request->id)->first();
        return response()->json($usuario, 200);
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
        $usuario = User::where('id',$request->id)->first();
        $usuario->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro de Usuario Eliminado'
        ]);
    }
    public function eliminarpersona(Request $request){
        $persona = Persona::where('id',$request->id)->first();
        $persona->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro de Persona Eliminado'
        ]);        
    }
}
