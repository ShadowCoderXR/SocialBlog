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
    <h1>Publicaciones del usuario</h1>
    @foreach ($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->body }}</td>
            <td><img src="{{ asset('storage/images/posts/' . $post->image) }}"></td>
            <td>

                <a href="{{route('post.show', $post->slug)}}">Ver las publicaciones</a>
                
                <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    
</body>
</html>
@endsection