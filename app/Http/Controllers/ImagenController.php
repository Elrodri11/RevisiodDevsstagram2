<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //Metodo para almacenera las imagenes
    public function store(Request $request)
    {       // Identificar el archivo que se sube a dropzone
        $imagen = $request->file('file');
        // Generar un nombre unico para la imagen
        $nombreImagen = Str::uuid().".".$imagen->extension();
        //Almacenar la imagen en el servidor
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);

        $imagenPath = public_path('uploads'). '/'. $nombreImagen;
        $imagenServidor->save($imagenPath);


            //Convertir el array de la imagen a json
        return response()->json(['imagen'=> $nombreImagen ]);
    }
}