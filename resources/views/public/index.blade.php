<x-layouts.app>
    <x-slot:title>Dana Sosial UNAND - Salurkan Kebaikan, Wujudkan Perubahan</x-slot:title>

    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                        <h1 class="hero-title mb-4 mt-5">Salurkan Kebaikan, Wujudkan Perubahan Bersama UNAND</h1>
                        <p class="hero-subtitle mb-4">Bergabunglah dengan komunitas akademik UNAND dalam mewujudkan
                            program sosial, wakaf, zakat, dan dana abadi yang berdampak positif bagi masyarakat luas.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('programs.index.public') }}" class="btn btn-success btn-lg me-3">Lihat
                                Program Donasi</a>
                            {{-- Arahkan ke section program di halaman ini --}}
                            <a href="#program" class="btn btn-outline-success btn-lg">Pelajari Lebih Lanjut</a>
                        </div>

                        <div class="hero-stats mt-5">
                            <div class="row">
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h4 class="stat-number">1.250+</h4>
                                        <p class="stat-label">Donatur</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h4 class="stat-number">65+</h4>
                                        <p class="stat-label">Program</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h4 class="stat-number">8.5M+</h4>
                                        <p class="stat-label">Terkumpul</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image text-center" data-aos="fade-left" data-aos-duration="1000"
                        data-aos-delay="400">
                        {{-- Ganti dengan gambar yang relevan dari folder public/frontend/img Anda --}}
                        <img src="{{ asset('frontend/img/rektorat.jpg') }}" alt="Kampus UNAND"
                            class="img-fluid rounded-3 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="program" class="program-section py-2">
        <div class="container">
            
            {{-- JUDUL UTAMA SECTION --}}
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title fw-bold">Pilih Program Wakaf</h2>
                    <p class="section-subtitle text-muted">Salurkan wakaf terbaik Anda melalui program unggulan kami</p>
                </div>
            </div>

            {{-- ========================================================== --}}
            {{-- SUB-SECTION 1: WAKAF UANG (HIGHLIGHT / DANA ABADI)       --}}
            {{-- ========================================================== --}}
            <div class="mb-5">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-cash-coin text-white"></i>
                    </div>
                    <h3 class="h4 fw-bold m-0 text-success">Wakaf Uang</h3>
                </div>

                {{-- Card Khusus Wakaf Uang (Desain Banner) --}}
                <div class="card border-0 shadow overflow-hidden rounded-4" data-aos="fade-up">
                    <div class="row g-0">
                        {{-- Kolom Gambar/Ilustrasi --}}
                        <div class="col-md-5 bg-light position-relative" style="min-height: 250px;">
                            {{-- Ganti URL gambar dengan gambar celengan/uang/aset wakaf --}}
                            <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?auto=format&fit=crop&q=80&w=800" 
                                 class="w-100 h-100 object-fit-cover" 
                                 alt="Wakaf Uang">
                            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.1);"></div>
                        </div>
                        
                        {{-- Kolom Konten --}}
                        <div class="col-md-7 d-flex align-items-center bg-white">
                            <div class="card-body p-4 p-lg-5">
                                <span class="badge bg-warning text-dark mb-2"> <i class="bi bi-star-fill me-1"></i> Program Utama</span>
                                <h3 class="fw-bold mb-3">Wakaf Uang Abadi UNAND</h3>
                                <p class="text-muted mb-4">
                                    Wakaf berupa uang tunai yang pokoknya dikelola secara abadi (tidak boleh berkurang), 
                                    dan hasil pengelolaannya disalurkan untuk beasiswa dan kemaslahatan umat. 
                                    Menjadi amal jariyah yang pahalanya terus mengalir.
                                </p>
                                
                                <div class="d-flex gap-3">
                                    {{-- Link ke Form Wakaf Uang Tunai --}}
                                    <!-- <a href="{{ route('public.wakaf-uang') }}" class="btn btn-success rounded-pill px-4 fw-bold">
                                        <i class="bi bi-heart-fill me-2"></i> Wakaf Sekarang
                                    </a> -->
                                    <a href="{{ route('public.wakaf-uang') }}" class="btn btn-outline-success rounded-pill px-4">
                                        Pelajari Lebih Lanjut
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Divider Pemisah Cantik --}}
            <hr class="my-5 border-secondary opacity-10">

            {{-- ========================================================== --}}
            {{-- SUB-SECTION 2: WAKAF MELALUI UANG (PROJECT BASED)        --}}
            {{-- ========================================================== --}}
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-buildings text-white"></i>
                    </div>
                    <div>
                        <h3 class="h4 fw-bold m-0 text-primary">Wakaf Melalui Uang</h3>
                    </div>
                </div>

                {{-- Grid Program (Looping Existing) --}}
                <div class="row g-4">
                    @forelse ($programs as $program)
                        @if($program->id == 1) @continue @endif
                        <div class="col-lg-4 col-md-6">
                            <div class="program-card card h-100 border-0 shadow-sm hover-lift" data-aos="fade-up" 
                                data-aos-delay="{{ $loop->iteration * 100 }}">
                                
                                {{-- Gambar Program --}}
                                <div class="program-image position-relative overflow-hidden rounded-top-3">
                                    <a href="{{ route('programs.show.public', $program->id) }}">
                                        <img src="{{ asset('storage/programs/' . $program->image) }}"
                                            alt="{{ $program->title }}" 
                                            class="card-img-top"
                                            style="height: 220px; width: 100%; object-fit: cover;">
                                    </a>
                                    <!-- <span class="badge bg-primary position-absolute top-0 end-0 m-3 shadow-sm">
                                        Project
                                    </span> -->
                                </div>

                                {{-- Konten Card --}}
                                <div class="card-body d-flex flex-column p-4">
                                    <h5 class="program-title fw-bold mb-3">
                                        <a href="{{ route('programs.show.public', $program->id) }}" class="text-decoration-none text-dark stretched-link">
                                            {{ Str::limit($program->title, 50) }}
                                        </a>
                                    </h5>
                                    
                                    <p class="program-description text-muted small mb-4">
                                        {{ Str::limit($program->description, 80) }}
                                    </p>

                                    <div class="mt-auto">
                                        {{-- Progress Bar --}}
                                        <div class="program-progress mb-3">
                                            <div class="d-flex justify-content-between mb-1 small fw-bold">
                                                <span class="text-primary">Terkumpul</span>
                                                <span class="text-muted">{{ $program->progres_persentase }}%</span>
                                            </div>
                                            <div class="progress rounded-pill bg-primary-subtle" style="height: 8px;">
                                                <div class="progress-bar bg-primary rounded-pill" role="progressbar"
                                                    style="width: {{ $program->progres_persentase }}%"></div>
                                            </div>
                                        </div>

                                        {{-- Statistik Angka --}}
                                        <div class="row text-center g-0 border rounded-3 py-2 bg-light small mb-3">
                                            <div class="col-6 border-end">
                                                <div class="fw-bold text-dark">Rp {{ $program->formatted_collected_amount }}</div>
                                                <div class="text-muted" style="font-size: 0.75rem;">Terkumpul</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="fw-bold text-dark">Rp {{ $program->formatted_target_amount }}</div>
                                                <div class="text-muted" style="font-size: 0.75rem;">Target</div>
                                            </div>
                                        </div>

                                        {{-- Tombol --}}
                                        <a href="{{ route('programs.show.public', $program->id) }}"
                                        class="btn btn-outline-primary w-100 fw-bold rounded-pill" style="position: relative; z-index: 2;">
                                        Ikut Berwakaf
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center py-5">
                                <i class="bi bi-info-circle fs-1 mb-3 d-block"></i>
                                <h5>Belum ada program project aktif saat ini.</h5>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- Tombol Lihat Semua --}}
                @if($programs->count() > 0)
                    <div class="text-center mt-5">
                        <a href="{{ route('programs.index.public') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                            Lihat Semua Program Wakaf Melalui Uang <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <section class="testimonial-section py-3 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">Kata Mereka Tentang Dana Sosial UNAND</h2>
                    <p class="section-subtitle">Testimoni dari para donatur dan penerima manfaat</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="testimonial-card text-center">
                                    <div class="testimonial-image mb-4">
                                        <img src="https://via.placeholder.com/80x80/198754/ffffff?text=DR"
                                            alt="Dr. Ahmad Rahman" class="rounded-circle">
                                    </div>
                                    <blockquote class="testimonial-quote">
                                        <p>"Platform ini memudahkan saya sebagai alumni untuk terus berkontribusi pada
                                            almamater. Transparansi laporannya sangat baik dan membuat saya percaya dana
                                            yang saya berikan benar-benar sampai ke tujuan."</p>
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <h6 class="author-name">Dr. Ahmad Rahman, S.T., M.T.</h6>
                                        <p class="author-title">Alumni Teknik Sipil '95, Direktur PT. Andalas
                                            Konstruksi</p>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="testimonial-card text-center">
                                    <div class="testimonial-image mb-4">
                                        <img src="https://via.placeholder.com/80x80/28a745/ffffff?text=SM"
                                            alt="Siti Mariam" class="rounded-circle">
                                    </div>
                                    <blockquote class="testimonial-quote">
                                        <p>"Berkat program beasiswa dari Dana Sosial UNAND, saya bisa menyelesaikan
                                            kuliah tanpa membebani orang tua. Sekarang saya bekerja dan ingin membalas
                                            kebaikan ini dengan menjadi donatur."</p>
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <h6 class="author-name">Siti Mariam</h6>
                                        <p class="author-title">Mahasiswa Farmasi, Penerima Beasiswa 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="berita" class="py-5 bg-light"> {{-- Kasih bg-light biar kontras sama section atasnya --}}
        <div class="container">
            
            {{-- Judul Section --}}
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="section-title fw-bold">Kabar & Berita Terkini</h2>
                    <p class="text-muted">Informasi terbaru seputar kegiatan dan penyaluran dana sosial</p>
                </div>
            </div>

            {{-- Grid Berita --}}
            <div class="row g-4">
                @forelse($articles as $article)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm hover-top overflow-hidden">
                            
                            {{-- Gambar Berita --}}
                            <div class="position-relative">
                                <a href="{{ route('articles.show.public', $article->slug ?? $article->id) }}">
                                    {{-- Cek ada gambar atau nggak --}}
                                    @if($article->image)
                                        <img src="{{ asset('storage/articles/' . $article->image) }}" 
                                            class="card-img-top" 
                                            alt="{{ $article->title }}"
                                            style="height: 200px; object-fit: cover;">
                                    @else
                                        {{-- Gambar Placeholder kalau gak ada gambar --}}
                                        <img src="https://via.placeholder.com/600x400/198754/ffffff?text=News" 
                                            class="card-img-top" 
                                            style="height: 200px; object-fit: cover;">
                                    @endif
                                </a>
                                
                                {{-- Badge Tanggal (Pojok Kanan Atas) --}}
                                <div class="bg-success text-white position-absolute bottom-0 start-0 px-3 py-2 small fw-bold rounded-top-end">
                                    <i class="bi bi-calendar-event me-1"></i> 
                                    {{ $article->created_at->format('d M Y') }}
                                </div>
                            </div>

                            {{-- Konten Berita --}}
                            <div class="card-body p-4 d-flex flex-column">
                                {{-- Kategori (Opsional, kalau ada kolom category_id) --}}
                                {{-- <small class="text-success fw-bold mb-2 text-uppercase">Berita Umum</small> --}}

                                <h5 class="card-title fw-bold mb-3">
                                    <a href="{{ route('articles.show.public', $article->slug ?? $article->id) }}" class="text-decoration-none text-dark">
                                        {{ Str::limit($article->title, 55) }}
                                    </a>
                                </h5>
                                
                                <p class="card-text text-muted small mb-4 flex-grow-1">
                                    {{-- Strip tags biar HTML summernote gak bocor, limit 100 karakter --}}
                                    {{ Str::limit(strip_tags($article->content), 100) }}
                                </p>

                                <a href="{{ route('articles.show.public', $article->slug ?? $article->id) }}" class="fw-bold text-success text-decoration-none stretched-link">
                                    Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada berita terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>

            {{-- Tombol Lihat Semua --}}
            @if($articles->count() > 0)
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ route('articles.index.public') }}" class="btn btn-outline-success rounded-pill px-4">
                            Lihat Arsip Berita <i class="bi bi-newspaper ms-2"></i>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </section>

</x-layouts.app>
