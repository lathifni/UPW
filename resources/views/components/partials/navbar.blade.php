{{-- Wrapper utama untuk latar belakang biru/hijau --}}
<header class="navbar-wrapper sticky-top">
    <div class="container">
        {{-- Kartu navbar yang melayang --}}
        <nav class="navbar navbar-expand-lg navbar-light navbar-floating">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('frontend/img/logo_unand.png') }}" alt="UNAND" height="40" />
                <span class="fw-bold text-success">Dana Sosial UNAND</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::routeIs(['public.wakaf-uang', 'wakaf-melalui-uang.index.public']) ? 'active' : '' }}"
                            href="#" id="navbarDropdownProgram" role="button" data-bs-toggle="dropdown">
                            Jenis
                        </a>
                        {{-- Tambahkan class 'custom-dropdown' biar gampang distyle --}}
                        <ul class="dropdown-menu custom-dropdown shadow-sm border-0"
                            aria-labelledby="navbarDropdownProgram">
                            <li><a class="dropdown-item {{ Request::routeIs('public.wakaf-uang') ? 'active' : '' }}"
                                    href="{{ route('public.wakaf-uang') }}">Wakaf Uang</a></li>
                            <li><a class="dropdown-item {{ Request::routeIs('wakaf-melalui-uang.index.public') ? 'active' : '' }}"
                                    href="{{ route('wakaf-melalui-uang.index.public') }}">Wakaf Melalui Uang</a></li>

                            {{-- Link Zakat Buka Tab Baru --}}
                            <li><a class="dropdown-item" href="http://upz.unand.ac.id/" target="_blank"
                                    rel="noopener noreferrer">Zakat <i
                                        class="bi bi-box-arrow-up-right ms-1 small"></i></a></li>

                            <li><a class="dropdown-item" href="#">Dana Abadi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('articles.*.public') ? 'active' : '' }}"
                            href="{{ route('articles.index.public') }}">Berita</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::routeIs(['pengurus.public', 'sejarah.public', 'legalitas.public']) ? 'active' : '' }}"
                            href="#" id="navbarDropdownTentang" role="button" data-bs-toggle="dropdown">
                            Tentang
                        </a>
                        <ul class="dropdown-menu custom-dropdown shadow-sm border-0"
                            aria-labelledby="navbarDropdownTentang">
                            <li><a class="dropdown-item {{ Request::routeIs('sejarah.public') ? 'active' : '' }}"
                                    href="{{ route('sejarah.public') }}">Sejarah</a></li>
                            <li><a class="dropdown-item {{ Request::routeIs('legalitas.public') ? 'active' : '' }}"
                                    href="{{ route('legalitas.public') }}">Legalitas</a></li>
                            <li><a class="dropdown-item {{ Request::routeIs('pengurus.public') ? 'active' : '' }}"
                                    href="{{ route('pengurus.public') }}">Kepengurusan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('laporan.public') ? 'active' : '' }}"
                            href="{{ route('laporan.public') }}">Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('edukasi-wakaf.public') ? 'active' : '' }}"
                            href="{{ route('edukasi-wakaf.public') }}">Edukasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-warning" href="#" data-bs-toggle="modal"
                            data-bs-target="#wakafUangModal">
                            Wakaf Sekarang
                        </a>
                    </li>
                </ul>

                <div class="d-flex gap-2 align-items-center mt-3 mt-lg-0">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4"
                            style="background-color: #84B179; border-color: #84B179;">Masuk</a>
                    @endguest

                    @auth
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="navbarDropdownUser" role="button" data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->avatar
                                    ? asset('storage/avatars/' . Auth::user()->avatar)
                                    : asset('storage/avatars/avatar.png') }}"
                                    alt="User" class="me-2 rounded-circle border border-success" width="32"
                                    height="32" style="object-fit: cover;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end custom-dropdown shadow-sm border-0 mt-2"
                                aria-labelledby="navbarDropdownUser">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i
                                            class="bi bi-speedometer2 me-2"></i> Dashboard Saya</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="bi bi-box-arrow-right me-2"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">@csrf</form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</header>
