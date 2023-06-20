<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    


    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index(User $user)
    {   
        //Obtenemos  los post de la publicacion del usuario
        $posts = Post::where('user_id', $user->id)->paginate(6);
            //Mostramos los post del usuario
            // dd($posts);


        return view('dashboard', [
            'user' => $user,
            //Pasamos los post de la publicacion a la vista del dashboard
            'posts' => $posts,
        ]);
    }
    

    //Crear metodo create para mostrar el formulario d publicacion
    public function create(){
      
        return view('post.create');
    }

  //Método para guardar imágenes
  public function store(Request $request) {
    $this->validate($request, [
        'titulo' => 'required|max:255',
        'descripcion' => 'required',
        'imagen' => 'required'
    ]);
    //Guardar los campos en el modelo Post
    /*Post::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'imagen' => $request->imagen,   //-> store('posts', 'public')
        //Identificar el usuario autenticado para guardarlo
        'user_id' => auth()->user()->id */

        //Guardar la informacion con relaciones (Modelo ER)
        //"post" es el nombre de la relacion
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,   
            'user_id' => auth()->user()->id
        ]);

    

    //Redireccionar al muro principal despues de guardar el post de la publicacion
    return redirect()->route('posts.index', auth()->user()->username);

}
}