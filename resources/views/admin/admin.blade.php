@extends('layouts.app')

@section('content')
            <a href="{{ route('admin.users') }}">Usuarios</a>
            <a href="{{ route('admin.posts') }}">Posts</a>
@endsection