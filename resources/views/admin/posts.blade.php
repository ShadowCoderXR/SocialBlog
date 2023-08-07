@extends('layouts.app')

@section('content')
//tabla de administrador de todas las publicaciones
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Contenido</th>
                <th>Estado</th>
                <th>comentarios</th>
                <th>ver publicacion</th>
                <th>Desactivar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>
                        {{$post->created_at}}
                    </td>
                    <td>
                        {{$post->title}}
                    </td>
                    <td>
                        <img src="{{ asset('storage/images/posts/' . $post->image) }}" class="img-publicacion" alt="..." width="100">
                    </td>
                    <td>
                        {{$post->body}}
                    </td>
                    <td>
                        @if($post->status == 1)
                            Activo
                        @else
                            Inactivo
                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin.comments', ['id' => $post->id])}}">Ver comentarios</a>
                    </td>
                    <td>
                        <a href="{{route('post.show', ['slug' => $post->slug])}}">Ver publicacion</a>
                    <td>
                        <form action="{{ route('admin.disable.posts', ['id' => $post->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit">Desactivar</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.destroy.posts', ['id' => $post->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection