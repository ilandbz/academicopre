<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function autenticar(Request $request){
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('/');
        }
        return redirect('login')->withsuccess('Datos No son Validos');
    }
    public function logout(){
        Auth::logout();
        Session::flush();

        return redirect('login');
    }
}
