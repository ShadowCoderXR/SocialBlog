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
<div>
        <h2>Cambiar contraseña</h2>

        @if (session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update.password') }}">
            @csrf

            <div>
                <label for="old_password">Contraseña actual</label>
                <input id="old_password" type="password" name="old_password" required autofocus>
                @error('old_password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Nueva contraseña</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation">Confirmar nueva contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <div>
                <button type="submit">Cambiar contraseña</button>
            </div>
        </form>
    </div>
</body>
</html>
@endsection