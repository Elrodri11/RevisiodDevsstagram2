<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // Definimos el metodo store
    public function store(Request $request, User $user, Post $post)
    {
        // Validamos los datos del formulario
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        // Guardamos los datos del formulario en la tabla comentarios
        Comentario::create([
            'comentario' => $request->comentario,
            //Obtenemos el usuario autenticado que comento
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);

        // Redireccionamos a la vista del post
        return back()->with('mensaje', 'Comentario agregado con éxito');
    }

    // Definimos el metodo destroy
    public function destroy(User $user, Post $post, Comentario $comentario)
    {
        //dd($comentario);
        // Eliminamos el comentario
        $comentario->delete();

        // Redireccionamos a la vista del post
        return back()->with('mensaje', 'Comentario eliminado con éxito');
    }
}