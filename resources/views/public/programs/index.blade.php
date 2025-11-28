<x-layouts.app>
    <x-slot:title>Program Donasi - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            .program-hero {
                background: linear-gradient(135deg,
                        rgba(25, 135, 84, 0.9) 0%,
                        rgba(32, 201, 151, 0.9) 100%),
                    url("https://via.placeholder.com/1920x600/198754/ffffff?text=Program+Donasi+UNAND") center/cover;
                color: white;
                padding: 100px 0;
            }

            .program-filter {
                background: white;
                padding: 2rem;
                border-radius: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                margin-top: -50px;
                position: relative;
                z-index: 10;
            }

            .filter-btn {
                border: 2px solid #e9ecef;
                background: white;
                color: #6c757d;
                padding: 0.5rem 1.5rem;
                border-radius: 2rem;
                margin: 0.25rem;
                transition: all 0.3s ease;
                text-decoration: none;
            }

            .filter-btn:hover,
            .filter-btn.active {
                background: #198754;
                border-color: #198754;
                color: white;
                text-decoration: none;
            }

            .program-category {
                margin-bottom: 3rem;
            }

            .category-header {
                border-left: 4px solid #198754;
                padding-left: 1rem;
                margin-bottom: 2rem;
            }

            .program-card-featured {
                border: 2px solid #198754;
                transform: scale(1.02);
            }

            .program-badge {
                position: absolute;
                top: 1rem;
                right: 1rem;
                z-index: 2;
            }

            .program-stats {
                background: #f8f9fa;
                border-radius: 0.5rem;
                padding: 1rem;
            }

            .search-box {
                position: relative;
            }

            .search-box input {
                padding-right: 3rem;
            }

            .search-box .search-icon {
                position: absolute;
                right: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: #6c757d;
            }

            .program-card-horizontal {
                display: flex;
                border: 1px solid #198754;
                border-radius: 0.75rem;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .program-card-horizontal:hover {
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                transform: translateY(-5px);
            }

            .program-card-horizontal .program-image {
                flex-shrink: 0;
            }

            .program-card-horizontal .program-content {
                padding: 1.5rem;
            }
        </style>
    @endpush

    <section class="program-hero" style="padding-top: 150px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Program Donasi</h1>
                    <p class="lead mb-4">Pilih program donasi yang sesuai dengan kepedulian Anda. Bersama kita wujudkan
                        perubahan yang berarti untuk kemajuan UNAND dan masyarakat.</p>
                    <div class="hero-stats">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">{{ $heroStats['active_programs'] }}+</h3>
                                    <p class="stat-label text-white-50">Program Aktif</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">
                                        {{ format_large_number($heroStats['total_collected']) }}</h3>
                                    <p class="stat-label text-white-50">Terkumpul</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">
                                        {{ format_large_number($heroStats['total_donors']) }}</h3>
                                    <p class="stat-label text-white-50">Donatur</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="program-filter-section py-0">
        <div class="container">
            <div class="program-filter">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h5 class="mb-3">Filter Program:</h5>
                        <div class="filter-buttons">
                            <a href="{{ route('programs.index.public') }}"
                                class="filter-btn {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">Semua
                                Program</a>
                            @foreach ($categories as $category)
                                <a href="{{ route('programs.index.public', ['category' => $category]) }}"
                                    class="filter-btn {{ request('category') == $category ? 'active' : '' }}">{{ Str::title($category) }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="search-box">
                            <input type="text" class="form-control" placeholder="Cari program..." />
                            <i class="bi bi-search search-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="program-list-section py-5">
        <div class="container">
            @if ($unggulan_programs->isNotEmpty())
                <div class="program-category">
                    <div class="category-header">
                        <h3 class="text-success mb-2">Program Unggulan</h3>
                        <p class="text-muted">Program prioritas yang membutuhkan dukungan segera.</p>
                    </div>
                    <div class="row g-4">
                        @foreach ($unggulan_programs as $program)
                            <div class="col-12" data-aos="fade-up">
                                <div class="program-card-horizontal">
                                    <div class="program-image d-none d-md-block">
                                        <a href="{{ route('programs.show.public', $program->id) }}">
                                            <img src="{{ asset('storage/programs/' . $program->image) }}"
                                                alt="{{ $program->title }}"
                                                style="width: 300px; height: 100%; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="program-content d-flex flex-column flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h4 class="program-title"><a
                                                    href="{{ route('programs.show.public', $program->id) }}"
                                                    class="text-decoration-none text-dark">{{ $program->title }}</a>
                                            </h4>
                                            <span
                                                class="badge bg-success flex-shrink-0 ms-3">{{ Str::title($program->category) }}</span>
                                        </div>
                                        <p class="program-description my-3">
                                            {{ Str::limit($program->description, 150) }}</p>
                                        <div class="program-progress mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <small class="text-muted">Terkumpul <strong>Rp
                                                        {{ $program->formatted_collected_amount }}</strong></small>
                                                <small class="text-muted">Target <strong>Rp
                                                        {{ $program->formatted_target_amount }}</strong></small>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $program->progres_persentase }}%"></div>
                                            </div>
                                        </div>
                                        <div class="program-stats border rounded p-3 mb-4">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <strong>{{ $program->progres_persentase }}%</strong>
                                                    <div class="small text-muted">Progress</div>
                                                </div>
                                                <div class="col-4">
                                                    <strong>{{ $program->deadline ? \Carbon\Carbon::parse($program->deadline)->diffForHumans(null, true) : '∞' }}</strong>
                                                    <div class="small text-muted">Tersisa</div>
                                                </div>
                                                <div class="col-4"><strong>{{ $program->donations->count() }}</strong>
                                                    <div class="small text-muted">Donatur</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 mt-auto">
                                            <a href="{{ route('programs.show.public', $program->id) }}"
                                                class="btn btn-success flex-fill">Lihat Detail</a>
                                            <a href="#" class="btn btn-outline-success"><i
                                                    class="bi bi-heart"></i> Donasi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr class="my-5">
            @endif

            <div class="program-category">
                @if ($unggulan_programs->isNotEmpty())
                    <div class="category-header">
                        <h3 class="text-success mb-2">Program Lainnya</h3>
                        <p class="text-muted">Jelajahi program kebaikan lainnya yang bisa Anda dukung.</p>
                    </div>
                @endif
                <div class="row g-4">
                    @forelse ($programs as $program)
                        <div class="col-lg-4 col-md-6">
                            <div class="program-card h-100" data-aos="fade-up">
                                <div class="program-image"><a
                                        href="{{ route('programs.show.public', $program->id) }}"><img
                                            src="{{ asset('storage/programs/' . $program->image) }}"
                                            alt="{{ $program->title }}" class="card-img-top"></a></div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="program-title"><a
                                            href="{{ route('programs.show.public', $program->id) }}"
                                            class="text-decoration-none text-dark">{{ $program->title }}</a></h5>
                                    <p class="program-description">{{ Str::limit($program->description, 90) }}</p>
                                    <div class="mt-auto">
                                        <div class="program-progress mb-3">
                                            <div class="d-flex justify-content-between mb-1"><small
                                                    class="text-muted">Terkumpul</small><small
                                                    class="text-muted">{{ $program->progres_persentase }}%</small>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $program->progres_persentase }}%"></div>
                                            </div>
                                        </div>
                                        <div class="program-stats mb-3">
                                            <div class="row text-center">
                                                <div class="col-6"><strong class="text-success">Rp
                                                        {{ $program->formatted_collected_amount }}</strong>
                                                    <div class="small text-muted">Terkumpul</div>
                                                </div>
                                                <div class="col-6"><strong class="text-success">Rp
                                                        {{ $program->formatted_target_amount }}</strong>
                                                    <div class="small text-muted">Target</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('programs.show.public', $program->id) }}"
                                            class="btn btn-success w-100">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">Tidak ada program donasi yang ditemukan untuk
                                saat ini.</div>
                        </div>
                    @endforelse
                </div>
                <div class="mt-5">
                    {{ $programs->links() }}
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
