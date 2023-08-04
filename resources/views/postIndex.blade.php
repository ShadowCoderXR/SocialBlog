@extends('layouts.app')

@section('content')
    <h1>Todas las publicaciones</h1>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Content</th>
                <th>Image</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->body }}</td>
                    <td><img src="{{ asset('storage/images/posts/' . $post->image) }}"></td>
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
    <h1>Crear nueva publicacion</h1>
    <form method="POST" action="{{ route('home.store')}}" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">
        <br>
        <br>
        <br>
        <label for="body">Contenido:</label>
        <textarea id="body" name="body"></textarea>
        <br>
        <br>
        <label for="image">Imagen:</label>
        <input type="file" id="image" name="image">
        <br>
        <br>
        <button type="submit" id="miboton">Crear Publicación</button>
    </form>
@endsection
