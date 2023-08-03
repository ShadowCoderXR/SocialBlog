@extends('layouts.app')

@section('content')
    <div>
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
        <p>{{ $post->slug }}</p>
        <p>Publicado por: {{ $post->user_id }}</p>
        <img src="{{ asset('storage/images/posts/' . $post->image) }}">

        <h2>Nuevo Comentario</h2>
        <form action="{{ route('comment.store', $post->id) }}" method="POST">
            @csrf
            <textarea name="comment" placeholder="Comentarios"></textarea>
            <button type="submit"  title="comment" id="miboton">Comentar</button>
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
                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>

    </div>
@endsection
