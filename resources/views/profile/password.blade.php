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
<h1>Cambiar Contraseña</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('profile.update.password') }}">
        @csrf
        <label for="old_password">Contraseña Antigua:</label>
        <input type="password" name="old_password" required><br>
        <label for="password">Nueva Contraseña:</label>
        <input type="password" name="password" required><br>
        <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
        <input type="password" name="password_confirmation" required><br>
        <button type="submit">Cambiar Contraseña</button>
    </form>
</body>
</html>
@endsection