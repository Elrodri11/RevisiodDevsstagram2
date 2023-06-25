<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //Método para almacenar imagenes
    public function store(Request $request){
        //Identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');
        //Convertir el array de la imagen a formato Json
        //return response()->json(['imagen' => $imagen->extension()]);

        //Generar un ID úcico para cargarse al server
        $nombreImagen = Str::uuid().'.'.$imagen->extension();

        //Utilizaremos Intervention Image para modificación de imagen
        $imagenServidor = Image::make($imagen);

        //Agregamos efectos a la imagen
        $imagenServidor->fit(1000, 1000);

        //Movemos la imagen de memoria (Contenedor Dropzone) a una ubicación fisica del server
        //La guardamos en "public/uploads"
        $imagenPath = public_path('uploads').'/'.$nombreImagen;
        $imagenServidor->save($imagenPath);

        //Verificar que el nombre del archivo sea único
        return response()->json(['imagen' => $nombreImagen]);
    }
}