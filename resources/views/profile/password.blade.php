<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('profile.update.password', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="old_password">Contraseña Antigua</label>
        <input type="password" name="old_password" id="old_password" required>
        <label for="new_password">Contraseña Nueva</label>
        <input type="password" name="new_password" id="new_password" required>
        <label for="password">Confirmar contraseña</label>
        <input type="new_password_confirmation" name="new_password_confirmation" id="new_password_confirmation" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>