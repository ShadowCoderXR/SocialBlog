@extends('layouts.app')

@section('content')
<!-- Projects-->
<section class="projects-section bg-light" id="projects">
<div class="container px-3 px-lg-4" style="max-width: 1200px;">

<header class="header-section" src="{{ asset('storage/images/social.webp') }}">
        <!-- Contenido del encabezado si es necesario -->
    </header>
                <!-- Featured Project Row-->
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-7 mb-lg-8" src="{{ asset('storage/images/social.webp') }}" alt="" width="550" /></div>
                    <div class="col-xl-4 col-lg-8">
                        <div class="featured-text text-center text-lg-left">
                            <h4>BLOG_SOCIAL</h4>
                            <p class="text-justify">¡Bienvenidos al fascinante mundo del Blog Social!</h4>En este espacio vibrante y lleno de energía, te invitamos a explorar, aprender y compartir. Somos más que un simple blog; somos una comunidad apasionada de individuos que buscan conectar, inspirar y expandir sus horizontes, saludos a todos ustedes.</p>
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear publicación</button>
                            </div>    
                    </div>
                </div>
                <!-- Project One Row-->
                @foreach ($posts as $post)
                <div class="row gx-0 mb-2 mb-lg-0 justify-content-center">
                    @if ($post->image != null)
                    <div class="col-lg-6"><img class="img-fluid" src="{{ asset('storage/images/posts/' . $post->image) }}" alt="..." /></div>
                    @else
                     Sin Imagen
                     @endif
                     <div class="col-lg-6">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left" style="padding: 20px;">
                                <h4 class="text-white">{{ $post->user->name }}</h4>
                                <h4 class="text-white">{{ $post->title }}</h4>
                                <p class="mb-0 text-white-50">{{ $post->body }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                @endforeach
                <!-- Project Two Row-->
                <div class="row gx-0 justify-content-center">
                    <div class="col-lg-6"><img class="img-fluid" src="assets/img/demo-image-02.jpg" alt="..." /></div>
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">Mountains</h4>
                                    <p class="mb-4 text-white-50">Another example of a project with its respective description. These sections work well responsively as well!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                 <div class="modal-content">
                                    <form method="POST" action="{{ route('home.store')}}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Crear Publicación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                 <label for="title" class="form-label">Title:</label>
                                                 <input type="text" class="form-control" id="title" name="title">
                                                 @error('title')
                                                 <p class="text-danger">{{ $message }}</p>
                                                 @enderror
                                                </div>
                                                <div class="mb-3">
                                                     <label for="body" class="form-label">Contenido:</label>
                                                    <textarea class="form-control" id="body" name="body"></textarea>
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
                                                    <button type="submit" class="btn btn-dark">Crear</button>
                                                </div>
                                             </form>
                                            </div>
                                        </div>
                                    </div>
                                </section><!-- End Modal -->
                            </div>
                         </section>
@endsection
