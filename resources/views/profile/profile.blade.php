@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Perfil</h1>
    @if($user->image != null)
        <img src="{{ asset('storage/images/profiles/' . $user->image) }}" class="img-publicacion" alt="..." width="100">
    @else
        sin imagen    
    @endif
    <ul>
        <li>
            Nombre: {{$user->name}}
        </li>
        <li>
            Email: {{$user->email}}
        </li>
        <li>
            Description: 
            @if($user->description == null)
                Sin descripción
            @endif
            {{$user->description}}
            
        </li>
        <li>
            Created at: {{$user->created_at}}
        </li>
    </ul>
    @if(Auth::id() == $user->id)
        <h1>Editar</h1>
        <a href="{{route('profile.edit', ['slug' => $user->slug])}}">Editar perfil</a>
        <h1>Publicaciones</h1>
        <a href="{{route('profile.posts', ['slug' => $user->slug])}}">Ver mis publicaciones</a>
        <h1>Eliminar</h1>
        <form action="{{ route('profile.destroy', ['id' => $user->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>

        <h1>Cambiar Contraseña</h1>
        <a href="{{route('profile.edit.password', ['slug' => $user->slug])}}">Cambiar contraseña</a>
    @endif
    </body>
</html>
@endsection