@extends('layouts.app')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Imagen</th>
                <th>Descripcion</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>ver perfil</th>
                <th>Desactivar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        {{$user->created_at}}
                    </td>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        <img src="{{ asset('storage/images/profiles/' . $user->image) }}" class="img-publicacion" alt="..." width="100">
                    </td>
                    <td>
                        {{$user->description}}
                    </td>
                    <td>
                        {{$user->role->name}}
                    </td>
                    <td>
                        @if($user->status == 1)
                            Activo
                        @else
                            Inactivo
                        @endif
                    </td>
                    <td>
                        <a href="{{route('profile.show', ['slug' => $user->slug])}}">Ver perfil</a>
                    <td>
                        <form action="{{ route('admin.disable.user', ['id' => $user->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit">Desactivar</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.destroy.user', ['id' => $user->id]) }}" method="post">
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