<?php

namespace App\Http\Controllers;

use Illuminate\Cache\RedisTagSet;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
       

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        
        ]);
      

        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales incorrectas');
            
        }

        //Credenciales correctas
        return redirect()->route('posts.index', auth()->user()->username);
    }
}