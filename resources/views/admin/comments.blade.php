@extends('layouts.app')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Comentario</th>
                <th>Usuario</th>
                <th>Estatus</th>
                <th>Deshabilitar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>
                        {{$comment->created_at}}
                    </td>
                    <td>
                        {{$comment->content}}
                    </td>
                    <td>
                        {{$comment->user->name}}
                    </td>
                    <td>
                        @if($comment->status == 1)
                            Activo
                        @else
                            Inactivo
                        @endif
                    <td>
                        <form action="{{ route('admin.disable.comments', ['id' => $comment->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit">Deshabilitar</button>
                        </form>
                    <td>
                        <form action="{{ route('admin.destroy.comments', ['id' => $comment->id]) }}" method="post">
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