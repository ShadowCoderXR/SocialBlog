<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Perfil</h1>
    <img src="{{ asset('storage/images/profiles/' . $user->image) }}" class="card-img-top" class="img-publicacion" alt="...">
    <ul>
        <li>
            Nombre: {{$user->name}}
        </li>
        <li>
            Slug: {{$user->slug}}
        </li>
        <li>
            Email: {{$user->email}}
        </li>
        <li>
            Password: {{$user->password}}
        </li>
        <li>
            Ruta de imagen: {{$user->image}}
        </li>
        <li>
            Description: {{$user->description}}
        </li>
        <li>
            Status: 
            
        @if($user->status == 1)
            Activo
        @else
            Inactivo
        @endif
        </li>
        <li>
            Created at: {{$user->created_at}}
        </li>
    </ul>
    <h1>Editar</h1>
    <a href="{{route('profile.edit', ['slug' => $user->slug])}}">Editar perfil</a>
</body>
</html>