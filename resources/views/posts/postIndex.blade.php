@extends('layouts.app')

@section('content')
<h1>Todas las publicaciones</h1>
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>publicación</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
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
        </tr>
        @endforeach
</table>
{{ $posts->links() }}

<h1>Crear nueva publicacion</h1>
<form method="POST" action="{{ route('home.store')}}" enctype="multipart/form-data">
    @csrf
    <label for="title">Title:</label>
    <input type="text" id="title" name="title">
    @error('title')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <br>

    <label for="body">Contenido:</label>
    <textarea id="body" name="body"></textarea>
    @error('body')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <br>

    <label for="image">Imagen:</label>
    <input type="file" id="image" name="image">
    @error('image')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    <br>

    <button type="submit" id="miboton">Crear Publicación</button>
</form>
@endsection