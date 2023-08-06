@extends('layouts.app')

@section('content')
<div>
    <hr>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <p>Publicado por: {{ $post->user->name}}</p>
    <p>Fecha de publicación: {{ $post->created_at }}</p>
    @if ($post->image != null)
        <img src="{{ asset('storage/images/posts/' . $post->image) }}" width="200">
    @else
        Sin Imagen
    @endif
</div>
<div>
    <hr>
    <h1>Comentarios</h1>
    <h2>Nuevo Comentario</h2>
    <form action="{{ route('comment.store',['id'=> $post->id])}}" method="POST">
        @csrf
        <textarea name="comment" placeholder="Comentarios"></textarea>
        <button type="submit" title="comment" id="miboton">Comentar</button>
    </form>
    <h2>Comentarios</h2>
    <ul>
        @foreach ($post->comments as $comment)
        <li>
            {{ $comment->content }}
            <br>
            {{ $comment->user_id }}
            <br>
            <br>
            <form action="{{ route('comment.destroy',['id'=> $comment->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
        @endforeach
    </ul>
</div>
<div>
    <hr>
    <h1>Editar Publicación</h1>
    <form action="{{ route('post.update',['id'=> $post->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="title">Title</label>
        <input type="text" name="title" id="title " value="{{ $post->title }}">
        <br>
        <br>
        <label for="body">Body</label>
        <input type="text" name="body" id="body" value="{{ $post->body }}">
        <br>
        <br>
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
        <br>
        <br>
        <button type="submit">Editar</button>
    </form>
</div>
<div>
    <hr>
    <h1>Eliminar publicación</h1>
    <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
</div>
@endsection