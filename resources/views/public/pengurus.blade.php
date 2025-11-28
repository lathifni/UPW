<x-layouts.app>
    <x-slot:title>Kepengurusan - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            .management-hero {
                background: linear-gradient(135deg,
                        rgba(25, 135, 84, 0.9) 0%,
                        rgba(32, 201, 151, 0.9) 100%),
                    url("https://via.placeholder.com/1920x600/198754/ffffff?text=Struktur+Kepengurusan") center/cover;
                color: white;
                padding: 100px 0;
            }

            .team-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                height: 100%;
                border: 1px solid #e9ecef;
            }

            .team-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }

            .team-image img {
                width: 120px;
                height: 120px;
                object-fit: cover;
                border: 4px solid #198754;
            }

            .team-name {
                color: var(--neutral-darker);
                margin-bottom: 0.5rem;
            }

            .team-position {
                color: #198754;
                font-weight: 600;
                margin-bottom: 0.25rem;
            }

            .team-role {
                color: #6c757d;
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }

            .team-description {
                color: #6c757d;
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .program-team-card {
                background: white;
                border-radius: 1rem;
                overflow: hidden;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
                height: 100%;
            }

            .program-team-card:hover {
                transform: translateY(-5px);
            }

            .org-chart {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .org-box {
                padding: 1.5rem;
                border-radius: 0.5rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .org-box.bg-success {
                max-width: 300px;
            }

            .org-box.bg-white {
                border: 2px solid #198754;
            }

            .connector-line {
                width: 2px;
                height: 40px;
                background: #198754;
                margin: 0 auto;
                position: relative;
            }

            .connector-line::before {
                content: "";
                position: absolute;
                top: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 0;
                height: 0;
                border-left: 10px solid transparent;
                border-right: 10px solid transparent;
                border-bottom: 10px solid #198754;
            }

            .management-stats {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                margin-top: -50px;
                position: relative;
                z-index: 10;
            }
        </style>
    @endpush

    <!-- Management Hero Section -->
    <section class="management-hero" style="padding-top: 150px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Struktur Kepengurusan</h1>
                    <p class="lead mb-4">
                        Tim profesional yang mengelola Dana Sosial UNAND dengan integritas
                        dan transparansi untuk mewujudkan program-program kebaikan.
                    </p>
                    <div class="hero-stats">
                        <div class="row justify-content-center">
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">{{ $stats['team_count'] }}</h3>
                                    <p class="stat-label text-white-50">Tim Pengurus</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">{{ $stats['division_count'] }}</h3>
                                    <p class="stat-label text-white-50">Level/Divisi</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">100%</h3>
                                    <p class="stat-label text-white-50">Profesional</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="management-stats-section py-0">
        <div class="container">
            <div class="management-stats">
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stats-card">
                            <div class="stats-icon"><i class="bi bi-award"></i></div>
                            {{-- Angka ini bersifat informatif, jadi kita biarkan statis --}}
                            <h3 class="text-success">5+</h3>
                            <p class="text-muted mb-0">Tahun Pengalaman</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stats-card">
                            <div class="stats-icon"><i class="bi bi-shield-check"></i></div>
                            <h3 class="text-success">100%</h3>
                            <p class="text-muted mb-0">Transparansi</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stats-card">
                            <div class="stats-icon"><i class="bi bi-graph-up-arrow"></i></div>
                            @php
                                $fund = $stats['managed_fund'];
                                if ($fund > 1000000000) {
                                    $formatted_fund = number_format($fund / 1000000000, 1) . 'M+';
                                } elseif ($fund > 1000000) {
                                    $formatted_fund = number_format($fund / 1000000, 1) . 'Jt+';
                                } else {
                                    $formatted_fund = number_format($fund);
                                }
                            @endphp
                            <h3 class="text-success">Rp {{ $formatted_fund }}</h3>
                            <p class="text-muted mb-0">Dana Terkelola</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stats-card">
                            <div class="stats-icon"><i class="bi bi-people"></i></div>
                            <h3 class="text-success">{{ $stats['successful_programs'] }}</h3>
                            <p class="text-muted mb-0">Program Sukses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="management-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-12 text-center mb-4">
                    <h2 class="section-title">Penanggung Jawab</h2>
                </div>
                @foreach ($penanggung_jawab as $pj)
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                        <div class="team-card text-center">
                            <div class="team-image mb-3"><img
                                    src="{{ $pj->image ? asset('storage/managements/' . $pj->image) : 'https://via.placeholder.com/120x120/198754/ffffff?text=' . substr($pj->name, 5, 1) }}"
                                    alt="{{ $pj->name }}" class="rounded-circle" /></div>
                            <h5 class="team-name">{{ $pj->name }}</h5>
                            <p class="team-position">{{ $pj->position }}</p>
                            <p class="team-role text-muted">{{ $pj->role }}</p>
                            @if ($pj->description)
                                <p class="team-description text-muted small">{{ $pj->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col-12 text-center mb-4">
                    <h2 class="section-title">Dewan Pengawas</h2>
                </div>
                @foreach ($dewan_pengawas as $pengawas)
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                        <div class="team-card text-center">
                            <div class="team-image mb-3"><img
                                    src="{{ $pengawas->image ? asset('storage/managements/' . $pengawas->image) : 'https://via.placeholder.com/120x120/198754/ffffff?text=' . substr($pengawas->name, 5, 1) }}"
                                    alt="{{ $pengawas->name }}" class="rounded-circle" /></div>
                            <h5 class="team-name">{{ $pengawas->name }}</h5>
                            <p class="team-position">{{ $pengawas->position }}</p>
                            <p class="team-role text-muted">{{ $pengawas->role }}</p>
                            @if ($pengawas->description)
                                <p class="team-description text-muted small">{{ $pengawas->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center">
                <div class="col-12 text-center mb-4">
                    <h2 class="section-title">Anggota UPW</h2>
                </div>
                @foreach ($anggota_upw_all as $anggota)
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                        <div class="team-card text-center">
                            <div class="team-image mb-3"><img
                                    src="{{ $anggota->image ? asset('storage/managements/' . $anggota->image) : 'https://via.placeholder.com/120x120/198754/ffffff?text=' . substr($anggota->name, 0, 1) }}"
                                    alt="{{ $anggota->name }}" class="rounded-circle" /></div>
                            <h5 class="team-name">{{ $anggota->name }}</h5>
                            <p class="team-position">{{ $anggota->position }}</p>
                            <p class="team-role text-muted">{{ $anggota->role }}</p>
                            @if ($anggota->description)
                                <p class="team-description text-muted small">{{ $anggota->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="org-chart-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Struktur Organisasi</h2>
                    <p class="section-subtitle">Alur koordinasi dan tanggung jawab dalam pengelolaan Dana Sosial UNAND
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="org-chart">
                        @if ($penanggung_jawab->isNotEmpty())
                            <div class="org-level text-center mb-4">
                                <div class="org-box bg-success text-white mx-auto">
                                    <h5 class="mb-1">{{ $penanggung_jawab->first()->position }}</h5>
                                    <small class="opacity-75">{{ $penanggung_jawab->first()->name }}</small>
                                </div>
                            </div>
                            <div class="org-connector text-center mb-4">
                                <div class="connector-line"></div>
                            </div>
                        @endif

                        @if ($dewan_pengawas->isNotEmpty())
                            <div class="org-level text-center mb-4">
                                <h6 class="text-muted mb-3">Dewan Pengawas</h6>
                                <div class="row justify-content-center">
                                    @foreach ($dewan_pengawas as $pengawas)
                                        <div class="col-md-6 mb-3">
                                            <div class="org-box bg-white border-success">
                                                <h6 class="mb-1">{{ $pengawas->position }}</h6>
                                                <small class="text-muted">{{ $pengawas->name }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="org-connector text-center mb-4">
                                <div class="connector-line"></div>
                            </div>
                        @endif

                        @if ($ketua_upw)
                            <div class="org-level text-center mb-4">
                                <div class="org-box bg-success text-white mx-auto">
                                    <h5 class="mb-1">{{ $ketua_upw->position }}</h5>
                                    <small class="opacity-75">{{ $ketua_upw->name }}</small>
                                </div>
                            </div>
                            <div class="org-connector text-center mb-4">
                                <div class="connector-line"></div>
                            </div>
                        @endif

                        @if ($staff_upw->isNotEmpty())
                            <div class="org-level">
                                <div class="row justify-content-center">
                                    @foreach ($staff_upw as $staff)
                                        <div class="col-md-4 mb-3" data-aos="fade-up">
                                            <div class="org-box bg-white border-success text-center">
                                                <h6 class="mb-1">{{ $staff->position }}</h6>
                                                <small class="text-muted">{{ $staff->name }}</small>
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
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: "ease-in-out",
                once: true,
            });
        </script>
    @endpush


</x-layouts.app>
