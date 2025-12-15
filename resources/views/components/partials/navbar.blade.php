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
                        <a class="nav-link dropdown-toggle {{ Request::routeIs(['public.wakaf-uang', 'programs.index.public']) ? 'active' : '' }}"
                            href="#" id="navbarDropdownProgram" role="button" data-bs-toggle="dropdown">
                            Program
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownProgram">
                            <li><a class="dropdown-item {{ Request::routeIs('public.wakaf-uang') ? 'active' : '' }}"
                                    href="{{ route('public.wakaf-uang') }}">Wakaf Uang</a></li>
                            <li><a class="dropdown-item {{ Request::routeIs('programs.index.public') ? 'active' : '' }}"
                                    href="{{ route('programs.index.public') }}">Wakaf Melalui Uang</a></li>
                            <li><a class="dropdown-item {{ Request::routeIs('pengurus.public') ? 'active' : '' }}"
                                    href="#">Zakat</a></li>
                            <li><a class="dropdown-item {{ Request::routeIs('pengurus.public') ? 'active' : '' }}"
                                    href="#">Dana Abadi</a></li>
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
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownTentang">
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
                            href="{{ route('edukasi-wakaf.public') }}">Edukasi Wakaf</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('edukasi-wakaf.public') ? 'active' : '' }}"
                            href="{{ route('edukasi-wakaf.public') }}">Wakaf Sekarang</a>
                    </li>
                </ul>

                <div class="d-flex gap-2 align-items-center">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Masuk</a>
                    @endguest

                    @auth
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="navbarDropdownUser" role="button" data-bs-toggle="dropdown">
                                @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="User"
                                        class="rounded-circle me-2" width="32" height="32"
                                        style="object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/32x32/198754/ffffff?text={{ substr(Auth::user()->nama, 0, 1) }}"
                                        alt="User" class="rounded-circle me-2" width="32" height="32">
                                @endif
                                <span class="text-success fw-medium">{{ Auth::user()->nama }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard Saya</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
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
