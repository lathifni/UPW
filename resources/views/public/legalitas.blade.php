<x-layouts.app>
    <x-slot:title>Legalitas - Dana Sosial UNAND</x-slot:title>

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
            .legalitas-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.8) 100%),
                    url("https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=1920") center/cover no-repeat;
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

            /* DOCUMENT CARD MODERN */
            .document-modern-card {
                background: white;
                border-radius: 24px;
                padding: 3rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
                border: none;
                margin-top: -60px;
                position: relative;
                z-index: 10;
                border-top: 6px solid var(--c-main);
            }

            .document-details-box {
                background: var(--c-pale);
                border-radius: 16px;
                padding: 2rem;
                margin: 2rem 0;
                border: 1px solid rgba(132, 177, 121, 0.2);
            }

            /* BUTTONS */
            .btn-download-modern {
                background: white;
                color: var(--c-main);
                border: 2px solid var(--c-main);
                padding: 0.8rem 2rem;
                border-radius: 50px;
                font-weight: 700;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            .btn-download-modern:hover {
                background: var(--c-main);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(132, 177, 121, 0.2);
            }

            /* IMPORTANCE CARD */
            .importance-card {
                background: white;
                border-radius: 20px;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
                border: 1px solid rgba(0, 0, 0, 0.03);
                transition: all 0.3s ease;
                height: 100%;
            }

            .importance-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(132, 177, 121, 0.1);
            }

            .icon-wrapper {
                width: 60px;
                height: 60px;
                background: var(--c-pale);
                color: var(--c-dark);
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
                font-size: 1.5rem;
            }

            /* ALERT INFO */
            .alert-modern {
                background: rgba(132, 177, 121, 0.1);
                border: 1px solid rgba(132, 177, 121, 0.3);
                border-radius: 16px;
                padding: 1.5rem;
                color: var(--c-dark);
            }
        </style>
    @endpush

    <section class="legalitas-hero">
        <div class="hero-pattern"></div>
        <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(10%, -10%);">
            <i class="bi bi-shield-check" style="font-size: 30rem;"></i>
        </div>

        <div class="container position-relative z-index-1">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start" data-aos="fade-right">
                    <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">Kepercayaan
                        & Transparansi</span>
                    <h1 class="display-4 fw-bolder mb-3">Legalitas UPW UNAND</h1>
                    <p class="fs-5 text-white-50 mb-0" style="line-height: 1.6;">
                        Dokumen resmi yang menjadi landasan hukum berdirinya dan beroperasinya Unit Pengelola Wakaf
                        Universitas Andalas.
                    </p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="row justify-content-center justify-content-lg-end g-3">
                        <div class="col-5 col-md-4">
                            <div class="stat-glass text-center">
                                <h2 class="fw-bolder mb-0 text-white">100%</h2>
                                <small class="text-white-50 text-uppercase fw-bold ls-1"
                                    style="font-size: 0.7rem;">Resmi & Sah</small>
                            </div>
                        </div>
                        <div class="col-5 col-md-4">
                            <div class="stat-glass text-center">
                                <h2 class="fw-bolder mb-0 text-white">2025</h2>
                                <small class="text-white-50 text-uppercase fw-bold ls-1"
                                    style="font-size: 0.7rem;">Tahun Disahkan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-0 position-relative z-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="document-modern-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-center mb-5">
                            <h2 class="fw-bolder" style="color: var(--c-dark);">Dokumen Legalitas Utama</h2>
                            <p class="text-muted fs-5">Landasan hukum yang menjamin pengelolaan wakaf di Universitas
                                Andalas.</p>
                        </div>

                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-md-center border-bottom pb-3 mb-4">
                            <div>
                                <h3 class="fw-bold mb-1" style="color: var(--c-main);">Keputusan Badan Pelaksana BWI
                                </h3>
                                <p class="text-muted mb-0">Tentang Penetapan Lembaga Nazhir Wakaf Uang Universitas
                                    Andalas</p>
                            </div>
                            <div class="mt-3 mt-md-0">
                                <span class="badge px-3 py-2 rounded-pill fs-6"
                                    style="background: var(--c-dark); color: white;">Dokumen Resmi</span>
                            </div>
                        </div>

                        <div class="document-details-box">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start mb-3">
                                        <i class="bi bi-hash text-success fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase fw-bold">Nomor SK</small>
                                            <span class="fw-bold fs-5 text-dark">70/BWI/NZ/2025</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-calendar-check text-success fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase fw-bold">Tanggal
                                                Penetapan</small>
                                            <span class="fw-bold fs-5 text-dark">12 Maret 2025</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 border-md-start ps-md-4">
                                    <div class="d-flex align-items-start mb-3">
                                        <i class="bi bi-building text-success fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase fw-bold">Penerbit</small>
                                            <span class="fw-bold fs-5 text-dark">Badan Wakaf Indonesia</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle text-success fs-5 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block text-uppercase fw-bold">Status & Masa
                                                Berlaku</small>
                                            <span class="badge bg-success me-2">Aktif</span> <span
                                                class="fw-bold text-dark">Tidak Terbatas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h5 class="fw-bold mb-3" style="color: var(--c-dark);">Isi Pokok Dokumen:</h5>
                            <ul class="text-muted fs-5" style="line-height: 1.8;">
                                <li>Menetapkan Universitas Andalas sebagai Nazhir Wakaf Uang yang sah.</li>
                                <li>Memberikan kewenangan penuh untuk mengelola dana wakaf uang.</li>
                                <li>Menetapkan ketentuan dan kewajiban hukum sebagai nazhir wakaf.</li>
                                <li>Mengatur mekanisme pelaporan dan pertanggungjawaban ke publik dan BWI.</li>
                            </ul>
                        </div>

                        <div class="d-flex gap-3 flex-wrap justify-content-center justify-content-md-start">
                            <a href="{{ asset('docs/sk-bwi-2025.pdf') }}" class="btn-download-modern" download>
                                <i class="bi bi-file-earmark-arrow-down-fill"></i> Download PDF
                            </a>
                            <a href="{{ asset('docs/sk-bwi-2025.pdf') }}" class="btn-download-modern" target="_blank">
                                <i class="bi bi-eye-fill"></i> Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 mb-5">
        <div class="container py-4">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <h2 class="fw-bolder" style="color: var(--c-dark);">Pentingnya Legalitas Wakaf</h2>
                    <p class="text-muted fs-5">Mengapa status legal formal ini krusial bagi UPW UNAND?</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="importance-card">
                        <div class="icon-wrapper"><i class="bi bi-shield-check"></i></div>
                        <h5 class="fw-bold mb-3" style="color: var(--c-dark);">Akuntabilitas</h5>
                        <p class="text-muted mb-0 small" style="line-height: 1.6;">Legalitas formal memastikan setiap
                            rupiah dana wakaf dikelola secara transparan dan dapat dipertanggungjawabkan di mata hukum.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="importance-card">
                        <div class="icon-wrapper"><i class="bi bi-award"></i></div>
                        <h5 class="fw-bold mb-3" style="color: var(--c-dark);">Kepercayaan</h5>
                        <p class="text-muted mb-0 small" style="line-height: 1.6;">Dokumen legalitas dari BWI
                            membangun kepercayaan penuh wakif (donatur) terhadap profesionalisme lembaga pengelola kami.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="importance-card">
                        <div class="icon-wrapper"><i class="bi bi-file-earmark-text"></i></div>
                        <h5 class="fw-bold mb-3" style="color: var(--c-dark);">Kepastian Hukum</h5>
                        <p class="text-muted mb-0 small" style="line-height: 1.6;">Landasan yang kuat memberikan
                            kepastian dan perlindungan dalam setiap kegiatan operasional penyaluran program wakaf.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="importance-card">
                        <div class="icon-wrapper"><i class="bi bi-graph-up-arrow"></i></div>
                        <h5 class="fw-bold mb-3" style="color: var(--c-dark);">Berkelanjutan</h5>
                        <p class="text-muted mb-0 small" style="line-height: 1.6;">Memungkinkan pengembangan investasi
                            instrumen wakaf dalam jangka panjang untuk kemaslahatan umat yang lebih luas.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5" data-aos="zoom-in">
                <div class="col-lg-10">
                    <div class="alert-modern d-flex align-items-center">
                        <i class="bi bi-info-circle-fill fs-2 me-4" style="color: var(--c-main);"></i>
                        <div>
                            <h5 class="fw-bold mb-1">Informasi Penting</h5>
                            <p class="mb-0 small" style="line-height: 1.6;">
                                Semua dokumen legalitas UPW UNAND telah diverifikasi dan sesuai dengan peraturan
                                perundang-undangan yang berlaku. Pengelolaan wakaf dilakukan dengan prinsip
                                kehati-hatian, transparansi, dan syariah <i>compliance</i>.
                            </p>
                        </div>
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
