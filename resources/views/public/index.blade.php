<x-layouts.app>
    <x-slot:title>Dana Sosial UNAND - Salurkan Kebaikan, Wujudkan Perubahan</x-slot:title>

    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                        <h1 class="hero-title mb-4">Salurkan Kebaikan, Wujudkan Perubahan Bersama UNAND</h1>
                        <p class="hero-subtitle mb-4">Bergabunglah dengan komunitas akademik UNAND dalam mewujudkan
                            program sosial, zakat, dan dana abadi yang berdampak positif bagi masyarakat luas.</p>
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

    <section class="key-values-section py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 mb-5">
                    <h2 class="section-title">Mengapa Memilih Dana Sosial UNAND?</h2>
                    <p class="section-subtitle">Komitmen kami terhadap transparansi, akuntabilitas, dan kemudahan dalam
                        berdonasi</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="value-card text-center h-100" data-aos="fade-up" data-aos-duration="800"
                        data-aos-delay="100">
                        <div class="value-icon mb-4">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="value-title mb-3">Transparan</h4>
                        <p class="value-description">Setiap donasi yang masuk dilaporkan secara real-time dengan
                            transparansi penuh kepada donatur.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="value-card text-center h-100" data-aos="fade-up" data-aos-duration="800"
                        data-aos-delay="300">
                        <div class="value-icon mb-4">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h4 class="value-title mb-3">Akuntabel</h4>
                        <p class="value-description">Laporan keuangan rutin dan audit independen memastikan penggunaan
                            dana sesuai tujuan.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="value-card text-center h-100" data-aos="fade-up" data-aos-duration="800"
                        data-aos-delay="500">
                        <div class="value-icon mb-4">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <h4 class="value-title mb-3">Mudah</h4>
                        <p class="value-description">Platform yang user-friendly dengan berbagai metode pembayaran yang
                            aman dan terpercaya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="program" class="program-section py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="section-title">Program Kebaikan Terbaru</h2>
                    <p class="section-subtitle">Pilih program donasi sesuai dengan kepedulian Anda</p>
                </div>
            </div>

            <div class="row g-4">
                @forelse ($programs as $program)
                    <div class="col-lg-4 col-md-6">
                        <div class="program-card h-100" data-aos="fade-up" data-aos-duration="800"
                            data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="program-image">
                                <img src="{{ asset('storage/programs/' . $program->image) }}"
                                    alt="{{ $program->title }}" class="card-img-top">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="program-title">{{ $program->title }}</h5>
                                <p class="program-description">{{ Str::limit($program->description, 100) }}</p>

                                <div class="mt-auto">
                                    <div class="program-progress mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <small class="text-muted">Terkumpul</small>
                                            <small class="text-muted">{{ $program->progres_persentase }}%</small>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $program->progres_persentase }}%"></div>
                                        </div>
                                    </div>

                                    <div class="program-stats mb-3">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <strong class="text-success">Rp
                                                    {{ $program->formatted_collected_amount }}</strong>
                                                <div class="small text-muted">Terkumpul</div>
                                            </div>
                                            <div class="col-6">
                                                <strong class="text-success">Rp
                                                    {{ $program->formatted_target_amount }}</strong>
                                                <div class="small text-muted">Target</div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('programs.show.public', $program->id) }}"
                                        class="btn btn-success w-100 mt-auto">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Belum ada program donasi yang tersedia saat ini.</p>
                        </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('programs.index.public') }}" class="btn btn-outline-success btn-lg">Lihat Semua
                    Program</a>
            </div>
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
</x-layouts.app>
