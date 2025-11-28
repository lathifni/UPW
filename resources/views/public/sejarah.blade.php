<x-layouts.app>
    <x-slot:title>Sejarah - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            .history-hero {
                background: linear-gradient(135deg,
                        rgba(25, 135, 84, 0.9) 0%,
                        rgba(32, 201, 151, 0.9) 100%),
                    url("https://via.placeholder.com/1920x600/198754/ffffff?text=Sejarah+UPW+UNAND") center/cover;
                color: white;
                padding: 100px 0;
            }

            .timeline-section {
                position: relative;
                padding: 4rem 0;
            }

            .timeline-container {
                position: relative;
                max-width: 1200px;
                margin: 0 auto;
            }

            .timeline-container::after {
                content: "";
                position: absolute;
                width: 6px;
                background: #198754;
                top: 0;
                bottom: 0;
                left: 50%;
                margin-left: -3px;
            }

            .timeline-card {
                padding: 10px 40px;
                position: relative;
                width: 50%;
                box-sizing: border-box;
            }

            .timeline-card::after {
                content: "";
                position: absolute;
                width: 25px;
                height: 25px;
                right: -13px;
                background: white;
                border: 4px solid #198754;
                top: 15px;
                border-radius: 50%;
                z-index: 1;
            }

            .left {
                left: 0;
            }

            .right {
                left: 50%;
            }

            .left::before {
                content: " ";
                height: 0;
                position: absolute;
                top: 22px;
                width: 0;
                z-index: 1;
                right: 30px;
                border: medium solid white;
                border-width: 10px 0 10px 10px;
                border-color: transparent transparent transparent white;
            }

            .right::before {
                content: " ";
                height: 0;
                position: absolute;
                top: 22px;
                width: 0;
                z-index: 1;
                left: 30px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            .right::after {
                left: -13px;
            }

            .timeline-content {
                padding: 20px 30px;
                background: white;
                position: relative;
                border-radius: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 1px solid #e9ecef;
            }

            .inspiration-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 1px solid #e9ecef;
                transition: transform 0.3s ease;
            }

            .inspiration-card:hover {
                transform: translateY(-5px);
            }

            .university-logo {
                width: 80px;
                height: 80px;
                background: #f8f9fa;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                border: 2px solid #198754;
            }

            .milestone-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border-left: 4px solid #198754;
                margin-bottom: 2rem;
            }

            @media screen and (max-width: 768px) {
                .timeline-container::after {
                    left: 31px;
                }

                .timeline-card {
                    width: 100%;
                    padding-left: 70px;
                    padding-right: 25px;
                }

                .timeline-card::before {
                    left: 60px;
                    border: medium solid white;
                    border-width: 10px 10px 10px 0;
                    border-color: transparent white transparent transparent;
                }

                .left::after,
                .right::after {
                    left: 18px;
                }

                .right {
                    left: 0%;
                }
            }
        </style>
    @endpush

    <!-- History Hero Section -->
    <section class="history-hero" style="padding-top: 150px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Sejarah UPW UNAND</h1>
                    <p class="lead mb-4">
                        Perjalanan panjang menuju kemandirian dan keberlanjutan pendanaan
                        pendidikan melalui wakaf
                    </p>
                    <div class="hero-stats">
                        <div class="row justify-content-center">
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">2022</h3>
                                    <p class="stat-label text-white-50">Awal Persiapan</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">4</h3>
                                    <p class="stat-label text-white-50">Dosen Nazhir</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">2025</h3>
                                    <p class="stat-label text-white-50">Berdiri Resmi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="introduction-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="milestone-card" data-aos="fade-up">
                        <h2 class="text-center mb-4">
                            Unit Pengelola Wakaf Universitas Andalas
                        </h2>
                        <p class="lead text-center mb-4">
                            Unit Pengelola Wakaf (UPW) Universitas Andalas secara
                            kelembagaan berdiri pada tanggal <strong>19 Maret 2025</strong>.
                            Persiapannya dimulai sejak tahun 2022 dengan mengirim 4 (empat)
                            orang dosen mengikuti Pelatihan / Sertifikasi Kompetensi Nazhir
                            Wakaf dan selanjutnya menjadi nazhir wakaf pada lembaga ini.
                        </p>
                        <div class="text-center">
                            <span class="badge bg-success fs-6 p-3">
                                <i class="bi bi-shield-check me-2"></i>
                                Terdaftar di Badan Wakaf Indonesia (BWI) sebagai Nazhir Wakaf
                                Uang Universitas Andalas
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Garis Waktu Sejarah</h2>
                    <p class="section-subtitle">
                        Perjalanan panjang menuju pendirian UPW UNAND
                    </p>
                </div>
            </div>

            <div class="timeline-container">
                <!-- 2022 -->
                <div class="timeline-card left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success text-white rounded-pill px-3 py-1 me-3">
                                <strong>2022</strong>
                            </div>
                            <h5 class="mb-0">Awal Persiapan</h5>
                        </div>
                        <p>
                            Persiapan dimulai dengan mengirim 4 (empat) orang dosen untuk
                            mengikuti Pelatihan / Sertifikasi Kompetensi Nazhir Wakaf.
                            Langkah ini menjadi fondasi penting dalam membangun kapasitas
                            pengelolaan wakaf yang profesional.
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-success">Pelatihan Nazhir</span>
                            <span class="badge bg-success">Sertifikasi Kompetensi</span>
                        </div>
                    </div>
                </div>

                <!-- 2023 -->
                <div class="timeline-card right" data-aos="fade-left">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success text-white rounded-pill px-3 py-1 me-3">
                                <strong>2023</strong>
                            </div>
                            <h5 class="mb-0">Studi Banding & Perencanaan</h5>
                        </div>
                        <p>
                            Melakukan studi banding ke berbagai perguruan tinggi yang telah
                            sukses mengelola dana abadi, termasuk Harvard, Yale, Stanford,
                            Princeton, MIT, serta perguruan tinggi dalam negeri seperti UIN
                            Jakarta, ITB Bandung, dan Unair Surabaya.
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-success">Studi Banding</span>
                            <span class="badge bg-success">Perencanaan Strategis</span>
                        </div>
                    </div>
                </div>

                <!-- 2024 -->
                <div class="timeline-card left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success text-white rounded-pill px-3 py-1 me-3">
                                <strong>2024</strong>
                            </div>
                            <h5 class="mb-0">Penyusunan Regulasi</h5>
                        </div>
                        <p>
                            Menyusun dokumen dan regulasi pendirian UPW, termasuk penyiapan
                            struktur organisasi, sistem pengelolaan, dan mekanisme
                            operasional. Proses koordinasi intensif dengan Badan Wakaf
                            Indonesia dan pihak internal universitas.
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-success">Regulasi</span>
                            <span class="badge bg-success">Koordinasi BWI</span>
                        </div>
                    </div>
                </div>

                <!-- Maret 2025 -->
                <div class="timeline-card right" data-aos="fade-left">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success text-white rounded-pill px-3 py-1 me-3">
                                <strong>12 Maret 2025</strong>
                            </div>
                            <h5 class="mb-0">Pengakuan BWI</h5>
                        </div>
                        <p>
                            Keputusan Badan Pelaksana Badan Wakaf Indonesia No : 70
                            /BWI/NZ/2025 tentang Penetapan Lembaga Nazhir Wakaf Uang
                            Universitas Andalas. Ini menjadi landasan hukum formal pengakuan
                            UPW sebagai nazhir wakaf uang.
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-success">SK BWI</span>
                            <span class="badge bg-success">Legalitas Formal</span>
                        </div>
                    </div>
                </div>

                <!-- 19 Maret 2025 -->
                <div class="timeline-card left" data-aos="fade-right">
                    <div class="timeline-content">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success text-white rounded-pill px-3 py-1 me-3">
                                <strong>19 Maret 2025</strong>
                            </div>
                            <h5 class="mb-0">Pendirian Resmi</h5>
                        </div>
                        <p>
                            Keputusan Rektor Universitas Andalas No.
                            1977/UN16.R/KPT/III/2025 tentang Penetapan Struktur Organisasi
                            dan No. 1978/UN16.R/KPT/III/2025 tentang Penetapan Pejabat Unit
                            Pengelola Wakaf Universitas Andalas. UPW resmi berdiri dan
                            beroperasi.
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-success">SK Rektor</span>
                            <span class="badge bg-success">Struktur Organisasi</span>
                            <span class="badge bg-success">Operasional</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Inspiration Section -->
    <section class="inspiration-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Inspirasi & Model Keberhasilan</h2>
                    <p class="section-subtitle">
                        Belajar dari pengalaman perguruan tinggi terkemuka dunia dan dalam
                        negeri
                    </p>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <div class="milestone-card">
                        <h4 class="text-success mb-3">Gagasan Awal</h4>
                        <p class="mb-4">
                            Gagasan untuk mendirikan lembaga wakaf di lingkungan Universitas
                            Andalas berakar dari kesadaran akan pentingnya kemandirian dan
                            keberlanjutan dukungan terhadap Tri Dharma Perguruan Tinggi
                            melalui sumber pendanaan alternatif yang mandiri dan
                            berkelanjutan.
                        </p>

                        <h5 class="text-success mb-3">Inspirasi Global</h5>
                        <p>
                            Kesuksesan beberapa universitas terkemuka di luar negeri seperti
                            <strong>Harvard, Yale, Stanford, Princeton, dan MIT</strong>
                            dalam mengelola dana abadi (endowment fund) - istilah yang lebih
                            universal dari wakaf, menjadi inspirasi dan motivasi dalam
                            mendirikan UPW.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        {{-- Salin script inline dari file HTML ke sini --}}
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
