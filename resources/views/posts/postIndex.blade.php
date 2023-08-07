@extends('layouts.app')

@section('content')

@vite(['resources/css/style.css', 'resources/js/main.js'])

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SOCIAL BLOG</title>


    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
    <h1>Social Blog</h1>
    <h2>Te damos la bienvenida comparte tus publicaciones</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Crear publicación
    </button>
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
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>


</section><!-- End Hero -->

<section id="events" class="events">
    <div class="container" data-aos="fade-up">
        <div class="row"> <!-- Eliminamos la clase row-cols-2 para que no divida automáticamente en columnas -->

            @php
                $colCount = 0;
            @endphp

            @foreach ($posts as $post)
                @if ($colCount == 0)
                <div class="col-md-6 custom-column">
                @endif

                <div class="card mb-4">
                    <div class="card-img">
                        @if ($post->image != null)
                        <img src="{{ asset('storage/images/posts/' . $post->image) }}" width="700" class="img-fluid">
                        @else
                        Sin Imagen
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('post.show', $post->slug)}}">{{ $post->title }}</a></h5>
                        <p class="fst-italic text-center">{{ $post->created_at }}</p>
                        <p class="card-text">{{ $post->body }}</p>
                    </div>
                </div>

                @php
                    $colCount++;
                @endphp

                @if ($colCount == 5) 
                </div>
                @php
                    $colCount = 0;
                @endphp
                @endif
            @endforeach

            @if ($colCount != 0)
            </div>
            @endif

        </div>
    </div>
</section><!-- End Events Section -->


{{ $posts->links() }}

<footer>
    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Mentor</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

@endsection