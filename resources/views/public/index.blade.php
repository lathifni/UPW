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

    <section id="program" class="program-section py-5">
        <div class="container">
            {{-- Judul Section --}}
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="section-title fw-bold">Program Wakaf</h2>
                    <p class="section-subtitle text-muted">Pilih program wakaf sesuai dengan kepedulian Anda</p>
                </div>
            </div>

            {{-- Grid Program --}}
            <div class="row g-4">
                @forelse ($programs as $program)
                    <div class="col-lg-4 col-md-6">
                        <div class="program-card card h-100 border-0 shadow-sm hover-lift" data-aos="fade-up" 
                            data-aos-delay="{{ $loop->iteration * 100 }}">
                            
                            {{-- Gambar Program (Dibuat Seragam) --}}
                            <div class="program-image position-relative overflow-hidden rounded-top-3">
                                <a href="{{ route('programs.show.public', $program->id) }}">
                                    <img src="{{ asset('storage/programs/' . $program->image) }}"
                                        alt="{{ $program->title }}" 
                                        class="card-img-top"
                                        style="height: 220px; width: 100%; object-fit: cover;"> {{-- KUNCI BIAR RAPI --}}
                                </a>
                                {{-- Badge Kategori (Opsional) --}}
                                <span class="badge bg-success position-absolute top-0 end-0 m-3 shadow-sm">
                                    {{ Str::title($program->category) }}
                                </span>
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
                                            <span class="text-success">Terkumpul</span>
                                            <span class="text-muted">{{ $program->progres_persentase }}%</span>
                                        </div>
                                        <div class="progress rounded-pill bg-success-subtle" style="height: 8px;">
                                            <div class="progress-bar bg-success rounded-pill" role="progressbar"
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
                                    class="btn btn-outline-success w-100 fw-bold rounded-pill" style="position: relative; z-index: 2;">
                                    Donasi Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center py-5">
                            <i class="bi bi-info-circle fs-1 mb-3 d-block"></i>
                            <h5>Belum ada program donasi aktif saat ini.</h5>
                            <p>Nantikan program kebaikan kami selanjutnya.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Tombol Lihat Semua --}}
            @if($programs->count() > 0)
                <div class="text-center mt-5">
                    <a href="{{ route('programs.index.public') }}" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm">
                        Lihat Semua Program <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section class="testimonial-section py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
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

    <section id="berita" class="program-section py-5">
        <div class="container">
            {{-- Judul Section --}}
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="section-title fw-bold">Berita Terkini</h2>
                </div>
            </div>

        </div>
    </section>

</x-layouts.app>
