@extends('layouts.app')

@section('content')
    <h1>Editar Publicación</h1>
    <form action="{{ route('post.update',['id'=> $post->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="title">Title</label>
        <input type="text" name="title" id="title "value="{{ $post->title }}">
        <br>
        <br>
        <label for="slug">Slug:</label>
        <input type="text" name="slug" id="slug" value="{{ $post->slug }}">
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
@endsection