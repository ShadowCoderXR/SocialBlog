@extends('layouts.app')

@vite(['resources/css/styles.css', 'resources/js/datatables-simples-demo.js', 'resources/js/scripts.js'])

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Social Blog</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<title>Dashboard - SB Admin</title>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Publicaciones</div>
                        <a class="nav-link" href="posts">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Admin publicaciones
                        </a>
                        <div class="sb-sidenav-menu-heading">Usuarios</div>
                        <a class="nav-link" href="users">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Admin usuarios
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Admin publicaciones</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Titulo</th>
                                        <th>Imagen</th>
                                        <th>Contenido</th>
                                        <th>Estado</th>
                                        <th>comentarios</th>
                                        <th>ver publicacion</th>
                                        <th>Desactivar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                @foreach($posts as $post)
                                <tbody>
                                    <tr>
                                        <td>
                                            {{$post->created_at}}
                                        </td>
                                        <td>
                                            {{$post->title}}
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/images/posts/' . $post->image) }}" class="img-publicacion" alt="..." width="100">
                                        </td>
                                        <td>
                                            {{$post->body}}
                                        </td>
                                        <td>
                                            @if($post->status == 1)
                                            Activo
                                            @else
                                            Inactivo
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.comments', ['id' => $post->id])}}" class="btn btn-primary">Ver comentarios</a>
                                        </td>
                                        <td>
                                            <a href="{{route('post.show', ['slug' => $post->slug])}}" class="btn btn-info">Ver publicación</a>
                                        <td>
                                            <form action="{{ route('admin.disable.posts', ['id' => $post->id]) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning">Desactivar</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.destroy.posts', ['id' => $post->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </td>

                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>