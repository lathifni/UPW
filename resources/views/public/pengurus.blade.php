<x-layouts.app>
    <x-slot:title>Kepengurusan - Dana Sosial UNAND</x-slot:title>

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
                overflow-x: hidden;
            }

            /* HERO SECTION MODERN */
            .management-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.8) 100%),
                    url("https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=1920") center/cover no-repeat;
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
                height: 100%;
            }

            .stat-glass:hover {
                transform: translateY(-5px);
                background: rgba(255, 255, 255, 0.15);
            }

            /* TEAM CARD MODERN */
            .team-card-modern {
                background: white;
                border-radius: 24px;
                padding: 2.5rem 1.5rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
                border: none;
                transition: all 0.4s ease;
                height: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                border-top: 5px solid transparent;
            }

            .team-card-modern:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(132, 177, 121, 0.15);
                border-top-color: var(--c-main);
            }

            .team-img-wrap {
                width: 140px;
                height: 140px;
                border-radius: 50%;
                padding: 5px;
                background: var(--c-pale);
                margin-bottom: 1.5rem;
                position: relative;
            }

            .team-img-wrap img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 50%;
                border: 4px solid white;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            .team-name {
                font-weight: 800;
                color: var(--c-dark);
                font-size: 1.2rem;
                margin-bottom: 0.25rem;
            }

            .team-position {
                color: var(--c-main);
                font-weight: 700;
                font-size: 0.95rem;
                margin-bottom: 1rem;
            }

            .team-role {
                background: var(--c-pale);
                color: var(--c-dark);
                padding: 5px 15px;
                border-radius: 50px;
                font-size: 0.8rem;
                font-weight: 600;
                margin-bottom: 1rem;
            }

            .team-desc {
                color: #64748b;
                font-size: 0.9rem;
                line-height: 1.6;
            }

            /* ORG CHART MODERN */
            .org-chart-modern {
                background: white;
                border-radius: 30px;
                padding: 4rem 2rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
                position: relative;
            }

            .org-box-modern {
                padding: 1.5rem;
                border-radius: 16px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.04);
                transition: all 0.3s;
                position: relative;
                z-index: 2;
            }

            .org-box-modern:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(132, 177, 121, 0.15);
            }

            .org-box-main {
                background: var(--c-main);
                color: white;
                border: none;
                max-width: 350px;
                margin: 0 auto;
            }

            .org-box-sub {
                background: white;
                border: 2px solid var(--c-pale);
                color: var(--c-dark);
            }

            .org-box-sub:hover {
                border-color: var(--c-main);
            }

            .connector-line-modern {
                width: 2px;
                height: 50px;
                background: var(--c-light);
                margin: 0 auto;
                position: relative;
                z-index: 1;
            }

            .connector-line-modern::before {
                content: "";
                position: absolute;
                top: -8px;
                left: 50%;
                transform: translateX(-50%);
                width: 12px;
                height: 12px;
                background: var(--c-main);
                border-radius: 50%;
            }

            .connector-line-modern::after {
                content: "";
                position: absolute;
                bottom: -8px;
                left: 50%;
                transform: translateX(-50%);
                width: 12px;
                height: 12px;
                background: var(--c-main);
                border-radius: 50%;
            }

            /* Section Title Styling */
            .section-title-modern {
                font-weight: 800;
                color: var(--c-dark);
                margin-bottom: 1rem;
                position: relative;
                display: inline-block;
            }

            .section-title-modern::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 50px;
                height: 4px;
                background: var(--c-main);
                border-radius: 10px;
            }
        </style>
    @endpush

    <section class="management-hero">
        <div class="hero-pattern"></div>
        <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(10%, -10%);">
            <i class="bi bi-diagram-3" style="font-size: 30rem;"></i>
        </div>

        <div class="container position-relative z-index-1">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start" data-aos="fade-right">
                    <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">Profil
                        Lembaga</span>
                    <h1 class="display-4 fw-bolder mb-3">Struktur Kepengurusan</h1>
                    <p class="fs-5 text-white-50 mb-0" style="line-height: 1.6;">
                        Tim profesional yang mengelola Dana Sosial UNAND dengan integritas dan transparansi untuk
                        mewujudkan program-program kebaikan.
                    </p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="row justify-content-center justify-content-lg-end g-3">
                        <div class="col-5 col-md-4">
                            <div class="stat-glass text-center">
                                <h2 class="fw-bolder mb-0 text-white">{{ $stats['team_count'] }}</h2>
                                <small class="text-white-50 text-uppercase fw-bold ls-1" style="font-size: 0.7rem;">Tim
                                    Pengurus</small>
                            </div>
                        </div>
                        <div class="col-5 col-md-4">
                            <div class="stat-glass text-center">
                                <h2 class="fw-bolder mb-0 text-white">{{ $stats['division_count'] }}</h2>
                                <small class="text-white-50 text-uppercase fw-bold ls-1"
                                    style="font-size: 0.7rem;">Divisi</small>
                            </div>
                        </div>
                        <div class="col-5 col-md-4 d-none d-md-block">
                            <div class="stat-glass text-center">
                                <h2 class="fw-bolder mb-0 text-white">100%</h2>
                                <small class="text-white-50 text-uppercase fw-bold ls-1"
                                    style="font-size: 0.7rem;">Profesional</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 mt-4">
        <div class="container">

            {{-- DEWAN PENGAWAS --}}
            <div class="mb-5 pb-5 border-bottom border-success border-opacity-10">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title-modern">Dewan Pengawas</h2>
                    <p class="text-muted mt-3">Mengawasi dan memastikan tata kelola wakaf berjalan sesuai prinsip
                        syariah dan regulasi BWI.</p>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($dewan_pengawas as $pengawas)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="team-card-modern text-center">
                                <h4 class="team-position fs-4 mb-2">{{ $pengawas->position }}</h4>
                                <span class="team-role">{{ $pengawas->role }}</span>
                                @if ($pengawas->description)
                                    <p class="team-desc mt-3 mb-0">{{ $pengawas->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ANGGOTA UPW --}}
            <div class="mb-5">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title-modern">Pengurus Harian UPW</h2>
                    <p class="text-muted mt-3">Tim eksekutif yang menjalankan operasional harian Dana Sosial UNAND.</p>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($anggota_upw_all as $anggota)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="team-card-modern text-center">
                                <div class="team-img-wrap">
                                    <img src="{{ $anggota->image ? asset('storage/managements/' . $anggota->image) : 'https://ui-avatars.com/api/?name=' . urlencode($anggota->name) . '&background=E8F5BD&color=1a2e15&size=200' }}"
                                        alt="{{ $anggota->name }}">
                                </div>
                                <h4 class="team-name">{{ $anggota->name }}</h4>
                                <p class="team-position">{{ $anggota->position }}</p>
                                <span class="team-role">{{ $anggota->role }}</span>
                                @if ($anggota->description)
                                    <p class="team-desc mt-3 mb-0">{{ $anggota->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <section class="py-5 bg-light mb-5">
        <div class="container py-4">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <h2 class="section-title-modern">Bagan Organisasi</h2>
                    <p class="text-muted mt-3">Alur koordinasi dan tanggung jawab dalam pengelolaan Dana Sosial UNAND.
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="org-chart-modern" data-aos="zoom-in">

                        {{-- DEWAN PENGAWAS (TOP LEVEL) --}}
                        @if ($dewan_pengawas->isNotEmpty())
                            <div class="text-center mb-0">
                                <span
                                    class="badge bg-pale-custom text-primary-custom px-3 py-2 rounded-pill mb-4 fw-bold">Unsur
                                    Pengawas</span>
                                <div class="row justify-content-center g-3">
                                    @foreach ($dewan_pengawas as $pengawas)
                                        <div class="col-md-5">
                                            <div class="org-box-modern org-box-sub text-center">
                                                <h6 class="fw-bold mb-1" style="color: var(--c-dark);">
                                                    {{ $pengawas->position }}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="connector-line-modern"></div>
                            </div>
                        @endif

                        {{-- KETUA (MID LEVEL) --}}
                        @if ($ketua_upw)
                            <div class="text-center mb-0">
                                <div class="org-box-modern org-box-main text-center">
                                    <h5 class="fw-bolder mb-1">{{ $ketua_upw->position }}</h5>
                                    <p class="mb-0 opacity-75 small fw-bold">{{ $ketua_upw->name }}</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="connector-line-modern"></div>
                            </div>
                        @endif

                        {{-- STAFF (BOTTOM LEVEL) --}}
                        @if ($staff_upw->isNotEmpty())
                            <div>
                                <div class="row justify-content-center g-4">
                                    @foreach ($staff_upw as $staff)
                                        <div class="col-md-4" data-aos="fade-up"
                                            data-aos-delay="{{ $loop->iteration * 100 }}">
                                            <div class="org-box-modern org-box-sub text-center h-100">
                                                <h6 class="fw-bold mb-2" style="color: var(--c-main);">
                                                    {{ $staff->position }}</h6>
                                                <p class="mb-0 text-muted small fw-bold">{{ $staff->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Initialize AOS jika belum ada di layout
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: "ease-in-out",
                    once: true,
                });
            }
        </script>
    @endpush

</x-layouts.app>
