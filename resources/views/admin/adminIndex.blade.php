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
                    <td><img src="{{ asset('storage/images/profiles/' . $user->image) }}"></td>
                    <td>{{ $user->role_id }}</td>
                    <td>{{ $user->description }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        <form action="{{ route('admin.destroy', ['id' => $user->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>

                        <a href="{{route('profile.show', ['slug'=>$user->slug])}}">Ver publicacion</a>
                    </td>
                </tr>
            @endforeach
    </table>
@endsection