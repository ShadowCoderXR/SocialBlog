<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Editar perfil</h1>
    <form action="{{route('profile.update', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}"><br>
        <label for="description">Descripción</label>
        <input type="text" name="description" id="description" value="{{ $user->description }}"><br>
        <label for="image">Imagen</label>
        <input type="file" name="image" id="image">
        <button type="submit">Enviar</button>
    </form>
<h1>Eliminar</h1>
    <form action="{{route('profile.destroy', ['id' => $user->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
</body>
</html>