@extends('layouts.app')

<!--Integramos username-->
@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w/12 md:flex">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img src="{{asset('img/usuario.svg')}}" alt="Imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <p class="text-gray-700 text-2xl">{{$user->username}}</p>

                <!-- Añadir mas contenido-->
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">0
                    <span class="font-normal">Post</span>
                </p>
            </div>

            <!--
            tabla para ver las publicaciones
            <div class="container grid px-6 mx-auto">
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-3/4 mx-auto my-8 border border-black">
                            <thead>
                                <tr class="border-b border-black">
                                    <th class="px-4 py-3 border-r border-black">Titulo</th>
                                    <th class="px-4 py-3 border-r border-black">Descripción</th>
                                    <th class="px-4 py-3 border-r border-black">Imagen</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr class="text-gray-700 dark:text-gray-400 border-b border-black">
                                    <td class="px-4 py-3 border-r border-black">{{$post->titulo}}</td>
                                    <td class="px-4 py-3 border-r border-black">{{$post->descripcion}}</td>
                                    <td class="px-4 py-3 border-r border-black">{{$post->imagen }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            -->

        </div>
    </div>

    <!--Recibir y mostrar los Post de publicación, se reciben desde PostController-->
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <!--Pasamos el valor de las variables post y username al URL-->
                        <a href="{{route('post.show' , ['post' => $post, 'user' => $user])}}">
                            <img src="{{asset('uploads'.'/'.$post->imagen)}}" alt="Imagen del Post {{$post->titulo}}">
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Paginación de los post-->
            <div class="container mx-auto my-10">
                {{$posts->links()}}
            </div>

        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold"> No existen publicaciones</p>
        @endif
    </section>

@endsection