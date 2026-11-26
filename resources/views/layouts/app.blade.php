<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Aplikasi Laravel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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


    <div class="container my-4 flex-grow-1">
        {{-- @if(session('sukses'))
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
        @endif --}}
        @yield('content')
    </div>

    <footer class="bg-dark text-light text-center py-3 mt-auto">
        <small>&copy; {{ date('Y') }} - Belajar Laravel 30 Hari</small>
    </footer>



    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="hapusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus <strong id="namaItem"></strong>?</p>
                    <p class="text-danger small">Aksi ini tidak bisa dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="formHapus" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        window.bukaModalHapus = function (url, nama) {
            document.getElementById('namaItem').textContent = nama || 'item ini';
            document.getElementById('formHapus').action = url;
            var modal = new bootstrap.Modal(document.getElementById('hapusModal'));
            modal.show();
        }
        @if(session('sukses'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('sukses') }}',
                timer: 5000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 5000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif
    </script>

</body>

</html>