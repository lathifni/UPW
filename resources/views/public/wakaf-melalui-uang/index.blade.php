<x-layouts.app>
    <x-slot:title>Program Wakaf Melalui Uang - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            :root {
                --c-main: #84B179;
                --c-hover: #A2CB8B;
                --c-light: #C7EABB;
                --c-pale: #E8F5BD;
                --c-dark: #1a2e15;
                --c-darker: #0f1c0c;
                --c-white-glass: rgba(255, 255, 255, 0.9);
            }

            body {
                background-color: #f8faf7;
            }

            /* HERO SECTION MODERN */
            .index-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.85) 100%),
                    url("https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&q=80&w=1920") center/cover no-repeat;
                color: white;
                padding: 160px 0 100px 0;
                position: relative;
                overflow: hidden;
            }

            .hero-pattern {
                position: absolute;
                inset: 0;
                opacity: 0.1;
                background-image: radial-gradient(#fff 1px, transparent 1px);
                background-size: 20px 20px;
            }

            /* STATS GLASS CARD */
            .stat-glass {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 20px;
                padding: 1.5rem;
                transition: transform 0.3s;
            }

            .stat-glass:hover {
                transform: translateY(-5px);
                background: rgba(255, 255, 255, 0.15);
            }

            /* SEARCH PILL */
            .search-pill {
                background: white;
                border-radius: 50px;
                padding: 8px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
                position: relative;
                z-index: 10;
                margin-top: -35px;
                display: flex;
                align-items: center;
                transition: all 0.3s;
            }

            .search-pill:focus-within {
                box-shadow: 0 20px 40px rgba(132, 177, 121, 0.2);
                transform: translateY(-2px);
            }

            .search-input {
                border: none;
                box-shadow: none !important;
                background: transparent;
                padding-left: 15px;
                font-size: 1.1rem;
            }

            /* BUTTONS */
            .btn-modern {
                background: var(--c-main);
                color: #fff;
                border: none;
                padding: 0.8rem 2rem;
                border-radius: 50px;
                font-weight: 700;
                transition: all 0.3s ease;
            }

            .btn-modern:hover {
                background: var(--c-dark);
                color: var(--c-pale);
                transform: translateY(-2px);
            }

            .btn-outline-modern {
                background: rgba(255, 255, 255, 0.5);
                color: var(--c-dark);
                border: 2px solid var(--c-main);
                padding: 0.6rem 1.5rem;
                border-radius: 50px;
                font-weight: 700;
                transition: all 0.3s ease;
            }

            .btn-outline-modern:hover {
                background: var(--c-main);
                color: #fff;
                border-color: var(--c-main);
            }

            /* HORIZONTAL CARD (UNGGULAN) */
            .card-horizontal-modern {
                background: white;
                border-radius: 24px;
                border: none;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.04);
                overflow: hidden;
                transition: all 0.4s ease;
                display: flex;
                flex-direction: column;
            }

            @media (min-width: 768px) {
                .card-horizontal-modern {
                    flex-direction: row;
                }
            }

            .card-horizontal-modern:hover {
                transform: translateY(-8px);
                box-shadow: 0 25px 50px rgba(132, 177, 121, 0.15);
            }

            .img-horizontal-wrapper {
                position: relative;
                overflow: hidden;
                min-height: 250px;
                width: 100%;
            }

            @media (min-width: 768px) {
                .img-horizontal-wrapper {
                    width: 40%;
                    min-height: 100%;
                }
            }

            .img-horizontal-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s ease;
            }

            .card-horizontal-modern:hover .img-horizontal-wrapper img {
                transform: scale(1.05);
            }

            /* GRID CARD (LAINNYA) */
            .program-card-modern {
                border: none;
                border-radius: 1.5rem;
                overflow: hidden;
                background: #fff;
                transition: all 0.4s ease;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.03);
            }

            .program-card-modern:hover {
                transform: translateY(-12px);
                box-shadow: 0 25px 50px rgba(132, 177, 121, 0.2);
            }

            .program-img-wrap {
                height: 220px;
                overflow: hidden;
                position: relative;
            }

            .program-img-wrap img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s ease;
            }

            .program-card-modern:hover .program-img-wrap img {
                transform: scale(1.08);
            }

            .program-content {
                padding: 1.8rem;
                position: relative;
                background: #fff;
                margin-top: -20px;
                border-radius: 1.5rem 1.5rem 0 0;
                z-index: 2;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            /* Progress Bar Modern */
            .progress-modern {
                height: 8px;
                background-color: var(--c-light);
                border-radius: 10px;
                overflow: hidden;
            }

            .progress-bar-modern {
                background-color: var(--c-main);
                border-radius: 10px;
                position: relative;
            }
        </style>
    @endpush

    {{-- HERO SECTION --}}
    <section class="index-hero">
        <div class="hero-pattern"></div>
        <div class="container position-relative z-index-1">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">Katalog
                        Project Based</span>
                    <h1 class="display-4 fw-bolder mb-3" style="letter-spacing: -1px;">Wakaf Melalui Uang</h1>
                    <p class="fs-5 text-white-50 mx-auto" style="line-height: 1.6;">
                        Pilih program pembangunan infrastruktur atau bantuan spesifik yang ingin Anda dukung. Setiap
                        rupiah Anda wujudkan perubahan nyata.
                    </p>
                </div>
            </div>

            {{-- STATS AREA --}}
            <div class="row justify-content-center g-3" data-aos="fade-up" data-aos-delay="100">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="stat-glass text-center h-100">
                        <h2 class="fw-bolder mb-0 text-white stat-number">{{ $heroStats['active_programs'] }}</h2>
                        <p class="small text-white-50 mb-0 mt-1 text-uppercase fw-bold ls-1"
                            style="font-size: 0.75rem;">Program Aktif</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="stat-glass text-center h-100">
                        <h2 class="fw-bolder mb-0 text-white stat-number"
                            data-target="{{ $heroStats['total_collected_raw'] }}"
                            data-format="{{ $heroStats['total_collected_fmt'] }}">0</h2>
                        <p class="small text-white-50 mb-0 mt-1 text-uppercase fw-bold ls-1"
                            style="font-size: 0.75rem;">Total Terkumpul</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 d-none d-md-block">
                    <div class="stat-glass text-center h-100">
                        <h2 class="fw-bolder mb-0 text-white stat-number"
                            data-target="{{ $heroStats['total_wakaf_masuk_raw'] }}"
                            data-format="{{ $heroStats['total_wakaf_masuk_fmt'] }}">0</h2>
                        <p class="small text-white-50 mb-0 mt-1 text-uppercase fw-bold ls-1"
                            style="font-size: 0.75rem;">Wakaf Masuk</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SEARCH FILTER PILL --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                {{-- Bungkus dengan Form GET --}}
                <form action="{{ route('wakaf-melalui-uang.index.public') }}" method="GET">
                    <div class="search-pill" data-aos="zoom-in" data-aos-delay="200">
                        <i class="bi bi-search text-muted fs-5 ms-3"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control search-input" placeholder="Cari program project based...">
                        <button type="submit" class="btn btn-modern">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT SECTION --}}
    <section class="py-5 mt-4">
        <div class="container">

            {{-- SECTION: PROGRAM UNGGULAN --}}
            @if ($unggulan_programs->isNotEmpty())
                <div class="mb-5 pb-4 border-bottom border-success border-opacity-10">
                    <div class="d-flex align-items-center mb-4" data-aos="fade-right">
                        <div class="bg-pale-custom text-primary-custom rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 45px; height: 45px;">
                            <i class="bi bi-star-fill fs-5"></i>
                        </div>
                        <div>
                            <h3 class="fw-bolder m-0" style="color: var(--c-dark);">Program Unggulan</h3>
                            <p class="text-muted small m-0">Project prioritas utama yang membutuhkan dukungan segera.
                            </p>
                        </div>
                    </div>

                    <div class="row g-4">
                        @foreach ($unggulan_programs as $program)
                            <div class="col-12" data-aos="fade-up">
                                <div class="card-horizontal-modern">
                                    <div class="img-horizontal-wrapper">
                                        <a href="{{ route('wakaf-melalui-uang.show.public', $program->slug) }}">
                                            <img src="{{ asset('storage/programs/' . $program->image) }}"
                                                alt="{{ $program->title }}">
                                        </a>
                                        <div class="position-absolute top-0 start-0 m-3">
                                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm"><i
                                                    class="bi bi-fire me-1"></i> Mendesak</span>
                                        </div>
                                    </div>

                                    <div class="p-4 p-lg-5 d-flex flex-column justify-content-center w-100">
                                        <h3 class="fw-bolder mb-2">
                                            <a href="{{ route('wakaf-melalui-uang.show.public', $program->slug) }}"
                                                class="text-decoration-none" style="color: var(--c-dark);">
                                                {{ $program->title }}
                                            </a>
                                        </h3>
                                        <span
                                            class="badge bg-pale-custom text-primary-custom d-inline-block align-self-start mb-3">Target
                                            Project</span>

                                        <p class="text-muted mb-4" style="line-height: 1.7; font-size: 1.05rem;">
                                            {{ Str::limit($program->description, 180) }}
                                        </p>

                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-end mb-2">
                                                <div>
                                                    <span class="d-block small text-muted">Terkumpul</span>
                                                    <span class="fw-bolder"
                                                        style="color: var(--c-main); font-size: 1.1rem;">Rp
                                                        {{ $program->formatted_collected_amount }}</span>
                                                </div>
                                                <div class="text-end">
                                                    <span class="d-block small text-muted">Target</span>
                                                    <span class="fw-bold text-dark">Rp
                                                        {{ $program->formatted_target_amount }}</span>
                                                </div>
                                            </div>

                                            <div class="progress-modern mb-4">
                                                <div class="progress-bar-modern"
                                                    style="width: {{ $program->progres_persentase }}%; height: 100%;">
                                                </div>
                                            </div>

                                            <div class="d-flex gap-3">
                                                <a href="{{ route('wakaf-melalui-uang.show.public', $program->slug) }}"
                                                    class="btn-modern flex-grow-1 text-center text-decoration-none">
                                                    Tunaikan Wakaf <i class="bi bi-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- SECTION: PROGRAM LAINNYA (GRID) --}}
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4" data-aos="fade-right">
                    <div class="bg-light-custom text-primary-custom rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 45px; height: 45px;">
                        <i class="bi bi-collection-fill fs-5"></i>
                    </div>
                    <div>
                        <h3 class="fw-bolder m-0" style="color: var(--c-dark);">Katalog Project</h3>
                        <p class="text-muted small m-0">Jelajahi project kebaikan lainnya yang bisa Anda dukung.</p>
                    </div>
                </div>

                <div class="row g-4 justify-content-center">
                    @forelse ($programs as $program)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up"
                            data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="program-card-modern h-100 d-flex flex-column">
                                <div class="program-img-wrap">
                                    <a href="{{ route('wakaf-melalui-uang.show.public', $program->slug) }}">
                                        <img src="{{ asset('storage/programs/' . $program->image) }}"
                                            alt="{{ $program->title }}">
                                    </a>
                                </div>

                                <div class="program-content">
                                    <h5 class="fw-bolder mb-3" style="line-height: 1.4;">
                                        <a href="{{ route('wakaf-melalui-uang.show.public', $program->slug) }}"
                                            class="text-decoration-none" style="color: var(--c-dark);">
                                            {{ Str::limit($program->title, 55) }}
                                        </a>
                                    </h5>

                                    <p class="text-muted small mb-4 flex-grow-1 line-height-lg">
                                        {{ Str::limit($program->description, 90) }}
                                    </p>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-end mb-2">
                                            <div>
                                                <span class="d-block small text-muted">Terkumpul</span>
                                                <span class="fw-bolder" style="color: var(--c-main);">Rp
                                                    {{ $program->formatted_collected_amount }}</span>
                                            </div>
                                            <div class="text-end">
                                                <span
                                                    class="fw-bold text-dark">{{ $program->progres_persentase }}%</span>
                                            </div>
                                        </div>

                                        <div class="progress-modern mb-4">
                                            <div class="progress-bar-modern"
                                                style="width: {{ $program->progres_persentase }}%; height: 100%;">
                                            </div>
                                        </div>

                                        <a href="{{ route('wakaf-melalui-uang.show.public', $program->slug) }}"
                                            class="btn-outline-modern w-100 d-block text-center text-decoration-none">
                                            Lihat Detail <i class="bi bi-arrow-right-circle ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="d-inline-block p-5 rounded-circle mb-3" style="background: var(--c-pale);">
                                <i class="bi bi-inboxes text-success display-1"></i>
                            </div>
                            <h4 class="fw-bold" style="color: var(--c-dark);">Belum Ada Project</h4>
                            <p class="text-muted">Belum ada katalog Wakaf Melalui Uang yang aktif untuk saat ini.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Custom Pagination Styling --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $programs->links() }}
                </div>
            </div>

        </div>
    </section>

</x-layouts.app>
