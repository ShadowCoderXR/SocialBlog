@extends('layouts.app')

@section('content')
    <h1>Todas los usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Email</th>
                <th>Image</th>
                <th>Role</th>
                <th>Description</th>
                <th>Status</th>
                <th>Deshabilitar</th>
                <th>Perfil</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->slug }}</td>
                    <td>{{ $user->email }}</td>
                    <td><img src="{{ asset('storage/images/profiles/' . $user->image) }}" width="100"></td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->description }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        <form action="{{ route('profile.destroy', ['id' => $user->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                    <td><a href="{{route('profile.show', ['slug'=>$user->slug])}}">Ver perfil</a></td>
                    <td>
                        <form action="{{ route('admin.destroy', ['id' => $user->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>
@endsection