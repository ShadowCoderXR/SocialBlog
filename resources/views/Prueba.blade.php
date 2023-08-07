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

<body>

    <!-- <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="index.html">Mentor</a></h1>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="active" href="index.html">Inicio</a></li>


                    <li class="dropdown"><a href="#"><span>Perfil</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Ver perfil</a></li>
                            <li><a href="#">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

            <a href="courses.html" class="get-started-btn">Publicar</a>

        </div>
    </header> -->

    <!-- ======= Hero Section ======= -->
    <img src="{{ asset('public/storage/portada.webp') }}" alt="" class="img-fluid">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
        <h1>Social Blog</h1>
        <h2>Te damos la bienvenida comparte tus publicaciones</h2>
        <a href="courses.html" class="btn-get-started">Publicar</a>
    </div>
    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container" data-aos="fade-up">


                <!-- Publicaciones -->
                @foreach ($posts as $post)
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            {{ $post->id }}
                            <h3>{{ $post->title }}</h3>
                            <p>
                                {{ $post->body }}
                            </p>

                            @if ($post->image != null)
                            <img src="{{ asset('storage/images/posts/' . $post->image) }}" width="200">
                            @else
                            Sin Imagen
                            @endif

                            <div class="text-center">
                                <a href="about.html" class="more-btn">Ver mas <i class="bx bx-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

    </main><!-- End #main -->

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

</body>

@endsection