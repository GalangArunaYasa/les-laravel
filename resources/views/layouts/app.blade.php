<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Aplikasi Laravel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Les Laravel</a>
            <div class="navbar-nav">
                <div class="dropdown">
                    <button class="nav-link dropdown-toggle text-white border-0 bg-transparent" type="button"
                        data-bs-toggle="dropdown">
                        Menu
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/halo">Halo</a></li>
                        <li><a class="dropdown-item" href="/about">Tentang</a></li>
                        <li><a class="dropdown-item" href="/catatan">Catatan</a></li>
                        <li><a class="dropdown-item" href="/kontak">Kontak</a></li>
                    </ul>
                </div>

                @auth
                    <div class="dropdown">
                        <button class="nav-link dropdown-toggle text-white border-0 bg-transparent" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Halo, {{ Auth::user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="/profile">Profil</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    @include('partials.loading')

    <div class="container my-4 flex-grow-1">
        @if(session('sukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @yield('content')
    </div>

    <footer class="bg-dark text-light text-center py-3 mt-auto">
        <small>&copy; {{ date('Y') }} - Belajar Laravel 30 Hari</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>