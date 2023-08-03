@extends('layouts.app')

@section('content')
    <h1>Editar Publicación</h1>
    <form action="{{ route('post.update', $post->id) }}" method="post">
        @csrf
        @method('PUT')

        <label for="title">Title</label>
        <input type="text" name="title" value="{{ $post->title }}">
        <br>
        <br>
        <label for="slug">Slug:</label>
        <input type="text" name="slug" value="{{ $post->slug }}">
        <br>
        <br>
        <label for="title">Body</label>
        <input type="text" name="body" value="{{ $post->body }}">
        <br>
        <br>
        <label for="image">Image</label>
        <input type="file" name="image">
        <br>
        <br>
        <button type="submit">Editar</button>
    </form>
@endsection