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
    <table>
    <thead>
        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>publicació</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->body }}</td>
            <td>
                @if ($post->image != null)
                    <img src="{{ asset('storage/images/posts/' . $post->image) }}" width="200">
                @else
                    Sin Imagen
                @endif
            </td>
            <td>
                <a href="{{route('post.show', $post->slug)}}">Ver publicación</a>
            </td>
            <td>
                <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
</table>
</body>
</html>
@endsection