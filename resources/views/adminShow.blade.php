@extends('layouts.app')

@section('content')
    <h1>Publicaciones de {{ $user->name }}</h1>

    @if (count($posts) > 0)
        <ul>
            @foreach ($posts as $post)
                <li>{{ $post->title }}</li>
                <p>{{ $post->body }}</p>
                <p>{{ $post->slug }}</p>
                <p>Publicado por: {{ $post->user_id }}</p>
                <img src="{{ asset('storage/images/posts/' . $post->image) }}">

                <h2>Nuevo Comentario</h2>
                <form action="{{ route('comment.store',['id'=> $post->id])}}" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="Comentarios"></textarea>
                    <button type="submit" title="comment" id="miboton">Comentar</button>
                </form>
            @endforeach
    @else
        <p>No hay publicaciones para mostrar.</p>
    @endif
@endsection
