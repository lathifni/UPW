<x-layouts.app>
    <x-slot:title>Sejarah - Dana Sosial UNAND</x-slot:title>

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
            .history-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.8) 100%),
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
                height: 100%;
            }

            .stat-glass:hover {
                transform: translateY(-5px);
                background: rgba(255, 255, 255, 0.15);
            }

            /* INTRO CARD MODERN */
            .intro-card {
                background: white;
                border-radius: 24px;
                padding: 3rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
                border: none;
                margin-top: -60px;
                position: relative;
                z-index: 10;
            }

            /* TIMELINE MODERN */
            .timeline-section {
                position: relative;
                padding: 5rem 0;
            }

            .timeline-container {
                position: relative;
                max-width: 1000px;
                margin: 0 auto;
            }

            .timeline-container::after {
                content: "";
                position: absolute;
                width: 4px;
                background: var(--c-pale);
                top: 0;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                border-radius: 4px;
            }

            .timeline-card {
                padding: 10px 40px;
                position: relative;
                width: 50%;
                box-sizing: border-box;
                margin-bottom: 2rem;
            }

            .timeline-card::after {
                content: "";
                position: absolute;
                width: 20px;
                height: 20px;
                background: white;
                border: 4px solid var(--c-main);
                top: 30px;
                border-radius: 50%;
                z-index: 2;
                box-shadow: 0 0 0 4px rgba(132, 177, 121, 0.2);
            }

            .left {
                left: 0;
                padding-right: 3rem;
            }

            .right {
                left: 50%;
                padding-left: 3rem;
            }

            .left::after {
                right: -10px;
            }

            .right::after {
                left: -10px;
            }

            .timeline-content {
                padding: 2rem;
                background: white;
                position: relative;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
                border: 1px solid rgba(0, 0, 0, 0.03);
                transition: all 0.3s ease;
            }

            .timeline-content:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(132, 177, 121, 0.1);
            }

            /* Panah Timeline */
            .left .timeline-content::before {
                content: " ";
                height: 0;
                position: absolute;
                top: 26px;
                width: 0;
                z-index: 1;
                right: -12px;
                border: medium solid white;
                border-width: 12px 0 12px 12px;
                border-color: transparent transparent transparent white;
            }

            .right .timeline-content::before {
                content: " ";
                height: 0;
                position: absolute;
                top: 26px;
                width: 0;
                z-index: 1;
                left: -12px;
                border: medium solid white;
                border-width: 12px 12px 12px 0;
                border-color: transparent white transparent transparent;
            }

            /* INSPIRATION CARD */
            .inspiration-card {
                background: white;
                border-radius: 24px;
                padding: 3rem;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.03);
                border: none;
                transition: transform 0.3s ease;
                border-top: 5px solid var(--c-main);
            }

            @media screen and (max-width: 768px) {
                .timeline-container::after {
                    left: 20px;
                }

                .timeline-card {
                    width: 100%;
                    padding-left: 50px;
                    padding-right: 0;
                }

                .timeline-card::after {
                    left: 10px;
                }

                .right {
                    left: 0%;
                }

                .left::after {
                    left: 10px;
                    right: auto;
                }

                .left .timeline-content::before {
                    left: -12px;
                    right: auto;
                    border-width: 12px 12px 12px 0;
                    border-color: transparent white transparent transparent;
                }
            }
        </style>
    @endpush

    <section class="history-hero">
        <div class="hero-pattern"></div>
        <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(10%, -10%);">
            <i class="bi bi-clock-history" style="font-size: 30rem;"></i>
        </div>

        <div class="container position-relative z-index-1">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start" data-aos="fade-right">
                    <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">Jejak
                        Langkah</span>
                    <h1 class="display-4 fw-bolder mb-3">Sejarah UPW UNAND</h1>
                    <p class="fs-5 text-white-50 mb-0" style="line-height: 1.6;">
                        Perjalanan panjang Universitas Andalas menuju kemandirian dan keberlanjutan pendanaan pendidikan
                        melalui instrumen wakaf.
                    </p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="row justify-content-center justify-content-lg-end g-3">
                        <div class="col-5 col-md-4">
                            <div class="stat-glass text-center">
                                <h2 class="fw-bolder mb-0 text-white">2022</h2>
                                <small class="text-white-50 text-uppercase fw-bold ls-1" style="font-size: 0.7rem;">Awal
                                    Ide</small>
                            </div>
                        </div>
                        <div class="col-5 col-md-4">
                            <div class="stat-glass text-center">
                                <h2 class="fw-bolder mb-0 text-white">4</h2>
                                <small class="text-white-50 text-uppercase fw-bold ls-1"
                                    style="font-size: 0.7rem;">Dosen Nazhir</small>
                            </div>
                        </div>
                        <div class="col-5 col-md-4 d-none d-md-block">
                            <div class="stat-glass text-center">
                                <h2 class="fw-bolder mb-0 text-white">2025</h2>
                                <small class="text-white-50 text-uppercase fw-bold ls-1"
                                    style="font-size: 0.7rem;">Berdiri Resmi</small>
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
                    <div class="intro-card text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="d-inline-flex align-items-center justify-content-center bg-pale-custom text-primary-custom rounded-circle mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="bi bi-bank fs-2"></i>
                        </div>
                        <h2 class="fw-bolder mb-4" style="color: var(--c-dark);">Unit Pengelola Wakaf Universitas
                            Andalas</h2>
                        <p class="fs-5 text-muted mb-4" style="line-height: 1.8;">
                            Unit Pengelola Wakaf (UPW) Universitas Andalas secara kelembagaan berdiri pada tanggal
                            <strong>19 Maret 2025</strong>.
                            Persiapannya dimulai sejak tahun 2022 dengan mengirim 4 (empat) orang dosen mengikuti
                            Pelatihan dan Sertifikasi Kompetensi Nazhir Wakaf.
                        </p>
                        <div
                            class="d-inline-block bg-light-custom text-primary-custom px-4 py-3 rounded-pill fw-bold fs-6">
                            <i class="bi bi-patch-check-fill me-2"></i> Resmi Terdaftar di Badan Wakaf Indonesia (BWI)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="timeline-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <h2 class="display-6 fw-bolder" style="color: var(--c-dark);">Garis Waktu Perjalanan</h2>
                    <p class="text-muted fs-5">Tonggak sejarah penting berdirinya UPW UNAND</p>
                </div>
            </div>

            <div class="timeline-container">
                <div class="timeline-card left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge px-3 py-2 rounded-pill fs-6 me-3"
                                style="background: var(--c-main); color: white;">2022</span>
                            <h4 class="mb-0 fw-bold" style="color: var(--c-dark);">Langkah Awal</h4>
                        </div>
                        <p class="text-muted mb-4" style="line-height: 1.7;">
                            Persiapan dimulai dengan mengirim 4 (empat) orang dosen untuk mengikuti Pelatihan /
                            Sertifikasi Kompetensi Nazhir Wakaf. Langkah ini menjadi fondasi penting dalam membangun
                            kapasitas pengelolaan wakaf yang profesional.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-pale-custom text-dark">Pelatihan Nazhir</span>
                            <span class="badge bg-pale-custom text-dark">Sertifikasi Kompetensi</span>
                        </div>
                    </div>
                </div>

                <div class="timeline-card right" data-aos="fade-left">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge px-3 py-2 rounded-pill fs-6 me-3"
                                style="background: var(--c-main); color: white;">2023</span>
                            <h4 class="mb-0 fw-bold" style="color: var(--c-dark);">Studi Banding</h4>
                        </div>
                        <p class="text-muted mb-4" style="line-height: 1.7;">
                            Melakukan riset dan studi banding ke berbagai perguruan tinggi yang telah sukses mengelola
                            dana abadi <i>(endowment fund)</i>, termasuk Harvard, Yale, Stanford, MIT, serta kampus
                            dalam negeri seperti UIN Jakarta dan ITB.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-pale-custom text-dark">Riset Global</span>
                            <span class="badge bg-pale-custom text-dark">Perencanaan Strategis</span>
                        </div>
                    </div>
                </div>

                <div class="timeline-card left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge px-3 py-2 rounded-pill fs-6 me-3"
                                style="background: var(--c-main); color: white;">2024</span>
                            <h4 class="mb-0 fw-bold" style="color: var(--c-dark);">Penyusunan Regulasi</h4>
                        </div>
                        <p class="text-muted mb-4" style="line-height: 1.7;">
                            Menyusun dokumen dan regulasi pendirian UPW, termasuk penyiapan struktur organisasi, sistem
                            pengelolaan, dan mekanisme operasional. Proses koordinasi intensif dengan Badan Wakaf
                            Indonesia dilakukan sepanjang tahun ini.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-pale-custom text-dark">Drafting Regulasi</span>
                            <span class="badge bg-pale-custom text-dark">Koordinasi BWI</span>
                        </div>
                    </div>
                </div>

                <div class="timeline-card right" data-aos="fade-left">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge px-3 py-2 rounded-pill fs-6 me-3"
                                style="background: var(--c-main); color: white;">12 Mar 2025</span>
                            <h4 class="mb-0 fw-bold" style="color: var(--c-dark);">Pengakuan Legal</h4>
                        </div>
                        <p class="text-muted mb-4" style="line-height: 1.7;">
                            Terbitnya Keputusan Badan Pelaksana Badan Wakaf Indonesia No: 70/BWI/NZ/2025 tentang
                            Penetapan Lembaga Nazhir Wakaf Uang Universitas Andalas. Ini menjadi landasan hukum formal
                            pengakuan UPW.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-pale-custom text-dark">SK BWI Terbit</span>
                            <span class="badge bg-pale-custom text-dark">Legalitas Formal</span>
                        </div>
                    </div>
                </div>

                <div class="timeline-card left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge px-3 py-2 rounded-pill fs-6 me-3"
                                style="background: var(--c-main); color: white;">19 Mar 2025</span>
                            <h4 class="mb-0 fw-bold" style="color: var(--c-dark);">Pendirian Resmi</h4>
                        </div>
                        <p class="text-muted mb-4" style="line-height: 1.7;">
                            Keputusan Rektor Universitas Andalas No. 1977/UN16.R/KPT/III/2025 tentang Penetapan Struktur
                            Organisasi dan No. 1978/UN16.R/KPT/III/2025 tentang Penetapan Pejabat. UPW Universitas
                            Andalas resmi berdiri dan beroperasi penuh.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-success">SK Rektor</span>
                            <span class="badge bg-success">Go Live</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="inspiration-card" data-aos="zoom-in">
                        <div class="row align-items-center">
                            <div class="col-md-5 text-center mb-4 mb-md-0 border-md-end">
                                <i class="bi bi-lightbulb text-warning display-1 mb-3"></i>
                                <h3 class="fw-bold" style="color: var(--c-dark);">Latar Belakang & Inspirasi</h3>
                            </div>
                            <div class="col-md-7 ps-md-5">
                                <h5 class="fw-bold mb-3" style="color: var(--c-main);">Gagasan Awal</h5>
                                <p class="text-muted mb-4">
                                    Berakar dari kesadaran akan pentingnya kemandirian pendanaan untuk mendukung Tri
                                    Dharma Perguruan Tinggi. Universitas membutuhkan sumber pendanaan alternatif yang
                                    tidak hanya mengandalkan UKT mahasiswa, melainkan dana yang mandiri dan
                                    berkelanjutan.
                                </p>
                                <h5 class="fw-bold mb-3" style="color: var(--c-main);">Inspirasi Global</h5>
                                <p class="text-muted mb-0">
                                    Kesuksesan universitas elit dunia seperti <strong>Harvard, Yale, Stanford, dan
                                        MIT</strong> dalam mengelola <i>Endowment Fund</i> (Dana Abadi) menjadi motivasi
                                    utama. Konsep Dana Abadi ini sangat sejalan dengan prinsip Wakaf Uang dalam Islam.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // AOS Init (Jika belum dipanggil global)
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
