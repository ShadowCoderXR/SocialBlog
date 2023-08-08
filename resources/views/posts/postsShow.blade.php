@extends('layouts.app')

@section('content')


@vite(['resources/css/style.css', 'resources/js/main.js'])

<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-3">
                <div class="d-flex align-items-center mt-lg-5 mb-4">
                    <hr>
                    @if($post->user->image != null)
                    <div class="rounded-circle overflow-hidden">
                        <img src="{{ asset('storage/images/profiles/' . $post->user->image) }}" alt="avatar" class="img-fluid rounded-circle" width="150">
                    </div>
                    @else
                    <div class="rounded-circle bg-secondary text-light d-flex justify-content-center align-items-center" width="100">
                        <span>Sin imagen</span>
                    </div>
                    @endif
                    <div class="ms-3">
                        <div class="fw-bold">{{ $post->user->name }}</div>
                    </div>
                    <hr>
                </div>


            </div>
            <div class="col-lg-9">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Fecha de publicación: {{ $post->created_at }}</div>
                        <!-- Post categories-->
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="{{ asset('storage/images/posts/' . $post->image) }}" alt="..." /></figure>
                    <!-- Post content-->
                    <div class="row justify-content-end">
                        <div class="col-auto mt-3">
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Editar Publicación</button>
                        </div>
                    </div>
                    <section class="mb-5">
                        <hr>
                        <p class="fs-5 mb-4">{{ $post->body }}</p>
                        <hr>
                    </section>
                </article>

                <!-- Modal para editar-->
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

                <!-- Comments section-->
                <section>
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            <form class="mb-4" action="{{ route('comment.store',['id'=> $post->id])}}" method="POST">
                                @csrf
                                <div class="d-flex align-items-center">
                                    @if($post->user->image != null)
                                    <div class="rounded-circle overflow-hidden">
                                        <img src="{{ asset('storage/images/profiles/' . $post->user->image) }}" alt="avatar" class="img-fluid rounded-circle" width="75">
                                    </div>
                                    @else
                                    <div class="rounded-circle bg-secondary text-light d-flex justify-content-center align-items-center" width="100">
                                        <span>Sin imagen</span>
                                    </div>
                                    @endif
                                    <h6 >{{ Auth::user()->name }}</h6>
                                </div>
                                <div class="mt-3">
                                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-auto mt-3">
                                        <button type="submit" class="btn btn-outline-secondary justify-content-end">Comentar</button>
                                    </div>
                                </div>

                                @foreach ($post->comments as $comment)
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        @if($post->user->image != null)
                                        <div class="rounded-circle overflow-hidden">
                                            <img src="{{ asset('storage/images/profiles/' . $post->user->image) }}" alt="avatar" class="img-fluid rounded-circle" width="100">
                                        </div>
                                        @else
                                        <div class="rounded-circle bg-secondary text-light d-flex justify-content-center align-items-center" width="100">
                                            <span>Sin imagen</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-bold">{{ $comment->user->name }}</div>
                                        {{ $comment->content }}
                                    </div>
                                </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

@endsection