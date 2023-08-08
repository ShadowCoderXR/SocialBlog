@extends('layouts.app')

@section('content')


@vite(['resources/css/style.css', 'resources/js/main.js'])


<div class="container">
    <h5>Fecha de publicación: {{ $post->created_at }}</h5>
    <h2>{{ $post->title }}</h2>
</div>

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <div class="">
                            <img src="{{ asset('storage/images/posts/' . $post->image) }}" alt="" width="700">
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-description">
                    <h2>{{ $post->title }}</h2>
                    <p>
                        {{ $post->body }}
                    </p>
                    <!-- <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success">Eliminar</button>
                    </form> -->
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Editar Publicación</button>
                    </div>
                </div>

            </div>

        </div>

</section><!-- End Portfolio Details Section -->

<!-- Modal de editar publicación -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Publicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post.update',['id'=> $post->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="title" class="col-form-label">Titulo:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="body" class="col-form-label">Contenido:</label>
                        <textarea class="form-control" id="body" name="body" value="{{ $post->body }}">{{ $post->body }}</textarea>
                        @error('body')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen:</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Borrar publicación
                    </button>
                    <button type="submit" class="btn btn-outline-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Borrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('comment.store',['id'=> $post->id])}}" method="POST">
                    @csrf
                    <h6>{{ Auth::user()->name }}:</h6>

                    <div class="d-flex align-items-center">
                        <div class="col mt-3">
                        <textarea class="form-control" id="content" name="content"></textarea>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-auto mt-3">
                            <button type="submit" class="btn btn-outline-success justify-content-end">Comentar</button>
                        </div>
                    </div>
                    <hr>
                    @foreach ($post->comments as $comment)
                    <h4 class="mr-3">{{ $comment->user->name }}</h4>
                    <h5 class="ml-auto">{{ $comment->content }}</h5>
                    @endforeach
                </form>
            </div>
        </div>
    </div>

</div>

<!-- ======= Footer ======= -->


@endsection