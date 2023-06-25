<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Crear nuestro primer metodo
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //Modificar el $request para que no se repitan los "username"
        $request->request->add(['username'=>Str::slug($request->username)]);

        // Validar campos de formulario
        $this->validate($request, [
            // Pasamos las reglas de validacion de cada uno de los campos
            // Validamos "username" y "email" como unico relacionados con la tabla "users" generada automaticamente con la instalacion de laravel
            'name' => 'required|min:4|max:20',
            'username' => 'required|unique:users|min:3|max:20',
            'email'=> 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);
        // Insertar datos a la tabla de usuarios
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        //Autenticar un usuario con el metodo "attemp"
        auth()->attempt($request->only('email','password'));
        //Redireccionando
        return redirect()->route('post.index',  auth()->user()->username);
    }
}