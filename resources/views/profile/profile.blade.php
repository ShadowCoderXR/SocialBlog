@extends('layouts.app')

@section('content')

@vite(['resources/css/style.css', 'resources/js/main.js'])
<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="assets/vendor/aos/aos.css" rel="stylesheet">
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

<div class="row">


    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="sticky-top">
                <div class="card-body text-center">
                    <h1>Tú perfil</h1>
                    <hr>
                    @if($user->image != null)
                    <div class="rounded-circle-wrapper">
                        <img src="{{ asset('storage/images/profiles/' . $user->image) }}" alt="avatar" class="img-fluid rounded-circle-image" width="200">
                    </div>
                    @else
                    <div class="rounded-circle bg-secondary text-light d-flex justify-content-center align-items-center" style="width: 75px; height: 75px;">
                        <span>Sin imagen</span>
                    </div>
                    @endif
                    <h5 class="my-3">{{$user->name}}</h5>
                    <p class="text-muted mb-1">{{$user->description}}</p>
                    @if($user->description == null)
                    <p class="text-muted mb-1">Sin descripción</p>
                    @endif
                    <p class="text-muted mb-4">Se ha unido en: {{$user->created_at}}</p>
                    <div class="d-flex justify-content-center mb-2">
                        <!-- <form action="{{route('profile.destroy', ['id' => $user->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-outline-danger ms-1">Borrar cuenta</button>
                        </form> -->
                        <div class="d-grid gap-2 m-2">
                            <a href="{{route('profile.edit.password', ['slug' => $user->slug])}}"><button class="btn btn-outline-warning">Cambiar contraseña</button></a>
                        </div>
                        <div class="d-grid gap-2 m-2">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Borrar cuenta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  borrar cuenta -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('profile.destroy', ['id' => $user->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Borrar cuenta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <div>
                                ¿Estas seguro de borrar tu cuenta?
                                <br>
                                Se eliminara de forma permanente.
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-outline-danger">Borrar cuenta</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    @if(Auth::id() == $user->id)
    <div class="col-lg-7">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{route('profile.update', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nombre</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Descripción</p>
                        </div>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description" value="{{ $user->description }}">{{ $user->description }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Foto:</p>
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email: {{$user->email}}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <section id="events" class="events">
            <h1 class="text-center">Tus publicaciones</h1>
            <hr>
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center"> <!-- Utilizamos 'justify-content-center' para centrar el contenido -->
                    @foreach ($user->posts as $post)
                    <div class="col-md-8 custom-column"> <!-- Aumentamos el tamaño de la columna a 'col-md-8' -->
                        <div class="card mb-4">
                            <div class="card-img">
                                @if ($post->image != null)
                                <a href="{{route('post.show', $post->slug)}}"><img src="{{ asset('storage/images/posts/' . $post->image) }}" width="700" class="img-fluid"></a>
                                @else
                                Sin Imagen
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{route('post.show', $post->slug)}}">{{ $post->title }}</a></h5>
                                <p class="fst-italic text-center">{{ $post->created_at }}</p>
                                <p class="card-text">{{ $post->body }}</p>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Borrar publicación
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Modal de borrar publicación -->

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Borrar publicación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <div>
                                ¿Estas seguro de borrar tu publicación?
                                <br>
                                Se eliminara de forma permanente.
                            </div>
                            <br>
                        </div>
                    </div>
                    @if($user->post != null)
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Borrar</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>


        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        @endsection