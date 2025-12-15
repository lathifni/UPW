<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <link rel="icon" type="image/x-icon" src="{{ asset('frontend/img/logo_unand.png') }}">

    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('styles')

</head>

<body id="page-top">
    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-text mx-3">Admin UNAND</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Manajemen Utama
            </div>

            <li class="nav-item {{ Request::routeIs('admin.donations.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.donations.index') }}">
                    <i class="fas fa-fw fa-heart"></i>
                    <span>Manajemen Wakaf Masuk</span>
                </a>
            </li>

            <li class="nav-item {{ Request::routeIs('admin.donations.cash.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.donations.cash.create') }}">
                    <i class="fas fa-fw fa-heart"></i>
                    <span>Input Wakaf Tunai</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/programs*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('programs.index') }}">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Manajemen Program</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Manajemen User</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/managements*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('managements.index') }}">
                    <i class="fas fa-fw fa-sitemap"></i>
                    <span>Manajemen Pengurus</span>
                </a>
            </li>

            <!-- <li class="nav-item {{ Request::is('admin/donations*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('managements.index') }}">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Manajemen Transaksi</span>
                </a>
            </li> -->

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Konten & Laporan
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-award"></i>
                    <span>Sertifikat</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/articles*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('articles.index') }}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Konten & Berita</span>
                </a>
            </li>

           <li class="nav-item {{ Request::routeIs('reports.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('reports.index') }}">
                    <i class="fas fa-fw fa-file-invoice"></i> {{-- Icon Dokumen --}}
                    <span>Laporan </span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan Sistem</span>
                </a>
            </li> -->

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->nama ?? 'Admin' }}</span>
                                <img class="img-profile rounded-circle" src="https://i.pravatar.cc/60?u=">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dana Sosial UNAND 2026</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- TAMBAHKAN KODE PEMICU DI SINI --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    <script>
        // Tangkap semua form dengan class 'delete-form'
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                // Hentikan aksi default form
                event.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    // Jika pengguna mengklik "Ya, hapus!"
                    if (result.isConfirmed) {
                        // Lanjutkan submit form
                        form.submit();
                    }
                })
            });
        });
    </script>

    @stack('scripts')

</body>

</html>
