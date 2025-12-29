<x-layouts.app>
    <x-slot:title>Legalitas - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            .legalitas-hero {
                background: linear-gradient(135deg,
                        rgba(25, 135, 84, 0.9) 0%,
                        rgba(32, 201, 151, 0.9) 100%),
                    url("https://via.placeholder.com/1920x600/198754/ffffff?text=Legalitas+UPW+UNAND") center/cover;
                color: white;
                padding: 10px 0;
            }

            .legalitas-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 1px solid #e9ecef;
                transition: transform 0.3s ease;
                height: 100%;
            }

            .legalitas-card:hover {
                transform: translateY(-5px);
            }

            .legalitas-icon {
                width: 80px;
                height: 80px;
                background: rgba(25, 135, 84, 0.1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                color: #198754;
                font-size: 2rem;
            }

            .document-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border-left: 4px solid #198754;
                margin-bottom: 2rem;
            }

            .document-header {
                border-bottom: 1px solid #e9ecef;
                padding-bottom: 1rem;
                margin-bottom: 1.5rem;
            }

            .document-badge {
                background: #198754;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 2rem;
                font-size: 0.875rem;
                font-weight: 600;
            }

            .document-details {
                background: #f8f9fa;
                border-radius: 0.5rem;
                padding: 1.5rem;
                margin: 1.5rem 0;
            }

            .download-btn {
                border: 2px solid #198754;
                color: #198754;
                padding: 0.75rem 1.5rem;
                border-radius: 2rem;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                font-weight: 600;
            }

            .download-btn:hover {
                background: #198754;
                color: white;
            }

            .legalitas-stats {
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

    <section class="legalitas-hero" style="padding-top: 100px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Legalitas UPW UNAND</h1>
                    <p class="lead mb-4">
                        Dokumen resmi yang menjadi landasan hukum berdirinya dan
                        beroperasinya Unit Pengelola Wakaf Universitas Andalas
                    </p>
                    <div class="hero-stats">
                        <div class="row justify-content-center">
                            <!-- <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">3</h3>
                                    <p class="stat-label text-white-50">Dokumen Legal</p>
                                </div>
                            </div> -->
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">100%</h3>
                                    <p class="stat-label text-white-50">Resmi & Sah</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">2025</h3>
                                    <p class="stat-label text-white-50">Tahun Berdiri</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="legalitas-overview-section py-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="document-card" data-aos="fade-up">
                        <div class="text-center mb-5">
                            <h2 class="section-title">Dokumen Legalitas UPW UNAND</h2>
                            <p class="section-subtitle">
                                Landasan hukum yang menjamin legalitas dan akuntabilitas
                                pengelolaan wakaf di Universitas Andalas
                            </p>
                        </div>

                        <div class="row g-4 justify-content-center">
                            <div class="col-lg-4 col-md-6">
                                <div class="legalitas-card text-center">
                                    <div class="legalitas-icon">
                                        <i class="bi bi-file-earmark-check"></i>
                                    </div>
                                    <h4>SK BWI</h4>
                                    <p class="text-muted">
                                        Pengakuan resmi dari Badan Wakaf Indonesia sebagai Nazhir
                                        Wakaf Uang
                                    </p>
                                    <div class="mt-3">
                                        <span class="badge bg-success">No. 70/BWI/NZ/2025</span>
                                    </div>
                                </div>
                            </div>
<!-- 
                            <div class="col-lg-4 col-md-6">
                                <div class="legalitas-card text-center">
                                    <div class="legalitas-icon">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <h4>SK Rektor</h4>
                                    <p class="text-muted">
                                        Penetapan struktur organisasi Unit Pengelola Wakaf
                                        Universitas Andalas
                                    </p>
                                    <div class="mt-3">
                                        <span class="badge bg-success">No. 1977/UN16.R/KPT/III/2025</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="legalitas-card text-center">
                                    <div class="legalitas-icon">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <h4>SK Rektor</h4>
                                    <p class="text-muted">
                                        Penetapan pejabat dan personalia Unit Pengelola Wakaf
                                        Universitas Andalas
                                    </p>
                                    <div class="mt-3">
                                        <span class="badge bg-success">No. 1978/UN16.R/KPT/III/2025</span>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="documents-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Detail Dokumen Legalitas</h2>
                    <p class="section-subtitle">
                        Informasi lengkap mengenai dokumen-dokumen legalitas UPW UNAND
                    </p>
                </div>
            </div>

            <!-- Document 1: SK BWI -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="document-card" data-aos="fade-up">
                        <div class="document-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="text-success mb-0">
                                    Keputusan Badan Pelaksana Badan Wakaf Indonesia
                                </h3>
                                <span class="document-badge">Dokumen Utama</span>
                            </div>
                        </div>

                        <div class="document-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Nomor:</strong>
                                        <span class="ms-2">70/BWI/NZ/2025</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Tanggal:</strong>
                                        <span class="ms-2">12 Maret 2025</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Tentang:</strong>
                                        <span class="ms-2">Penetapan Lembaga Nazhir Wakaf Uang Universitas
                                            Andalas</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Penerbit:</strong>
                                        <span class="ms-2">Badan Wakaf Indonesia</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Status:</strong>
                                        <span class="ms-2 badge bg-success">Aktif</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Masa Berlaku:</strong>
                                        <span class="ms-2">Tidak Terbatas</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-3">Isi Pokok Dokumen:</h5>
                        <ul class="mb-4">
                            <li class="mb-2">
                                Menetapkan Universitas Andalas sebagai Nazhir Wakaf Uang
                            </li>
                            <li class="mb-2">
                                Memberikan kewenangan untuk mengelola dana wakaf uang
                            </li>
                            <li class="mb-2">
                                Menetapkan ketentuan dan kewajiban sebagai nazhir wakaf
                            </li>
                            <li class="mb-2">
                                Mengatur mekanisme pelaporan dan pertanggungjawaban
                            </li>
                        </ul>

                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ asset('docs/sk-bwi-2025.pdf') }}" 
                                class="download-btn btn btn-outline-success" 
                                download> 
                                    <i class="bi bi-file-pdf"></i> Download PDF
                            </a>
                            <a href="{{ asset('docs/sk-bwi-2025.pdf') }}" 
                                class="download-btn btn btn-outline-success" 
                                target="_blank">
                                    <i class="bi bi-eye"></i> Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document 2: SK Rektor Struktur Organisasi -->
            <!-- <div class="row mb-5">
                <div class="col-12">
                    <div class="document-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="document-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="text-success mb-0">
                                    Keputusan Rektor Universitas Andalas
                                </h3>
                                <span class="document-badge">Struktur Organisasi</span>
                            </div>
                        </div>

                        <div class="document-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Nomor:</strong>
                                        <span class="ms-2">1977/UN16.R/KPT/III/2025</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Tanggal:</strong>
                                        <span class="ms-2">19 Maret 2025</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Tentang:</strong>
                                        <span class="ms-2">Penetapan Struktur Organisasi Unit Pengelola Wakaf
                                            Universitas Andalas</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Penerbit:</strong>
                                        <span class="ms-2">Rektor Universitas Andalas</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Status:</strong>
                                        <span class="ms-2 badge bg-success">Aktif</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Masa Berlaku:</strong>
                                        <span class="ms-2">5 Tahun</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-3">Isi Pokok Dokumen:</h5>
                        <ul class="mb-4">
                            <li class="mb-2">
                                Menetapkan struktur organisasi Unit Pengelola Wakaf (UPW)
                            </li>
                            <li class="mb-2">
                                Menentukan tugas dan fungsi masing-masing unit dalam struktur
                            </li>
                            <li class="mb-2">
                                Mengatur hubungan kerja antar unit dalam organisasi
                            </li>
                            <li class="mb-2">
                                Menetapkan mekanisme koordinasi dan pengambilan keputusan
                            </li>
                        </ul>

                        <div class="d-flex gap-3 flex-wrap">
                            <a href="#" class="download-btn">
                                <i class="bi bi-file-pdf"></i> Download PDF
                            </a>
                            <a href="#" class="download-btn">
                                <i class="bi bi-eye"></i> Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Document 3: SK Rektor Pejabat -->
            <!-- <div class="row">
                <div class="col-12">
                    <div class="document-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="document-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="text-success mb-0">
                                    Keputusan Rektor Universitas Andalas
                                </h3>
                                <span class="document-badge">Penetapan Pejabat</span>
                            </div>
                        </div>

                        <div class="document-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Nomor:</strong>
                                        <span class="ms-2">1978/UN16.R/KPT/III/2025</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Tanggal:</strong>
                                        <span class="ms-2">19 Maret 2025</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Tentang:</strong>
                                        <span class="ms-2">Penetapan Pejabat Unit Pengelola Wakaf Universitas
                                            Andalas</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Penerbit:</strong>
                                        <span class="ms-2">Rektor Universitas Andalas</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Status:</strong>
                                        <span class="ms-2 badge bg-success">Aktif</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Masa Berlaku:</strong>
                                        <span class="ms-2">5 Tahun</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-3">Isi Pokok Dokumen:</h5>
                        <ul class="mb-4">
                            <li class="mb-2">
                                Menetapkan pejabat struktural Unit Pengelola Wakaf
                            </li>
                            <li class="mb-2">
                                Menentukan tugas, wewenang, dan tanggung jawab masing-masing
                                pejabat
                            </li>
                            <li class="mb-2">
                                Mengatur mekanisme pengangkatan dan pemberhentian pejabat
                            </li>
                            <li class="mb-2">
                                Menetapkan masa jabatan dan evaluasi kinerja pejabat
                            </li>
                        </ul>

                        <div class="d-flex gap-3 flex-wrap">
                            <a href="#" class="download-btn">
                                <i class="bi bi-file-pdf"></i> Download PDF
                            </a>
                            <a href="#" class="download-btn">
                                <i class="bi bi-eye"></i> Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>

    <section class="importance-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="document-card">
                        <h2 class="text-center mb-4">
                            Pentingnya Legalitas dalam Pengelolaan Wakaf
                        </h2>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-shield-check text-success" style="font-size: 1.5rem"></i>
                                    </div>
                                    <div>
                                        <h5>Akuntabilitas</h5>
                                        <p class="text-muted mb-0">
                                            Legalitas formal memastikan pengelolaan wakaf dilakukan
                                            secara transparan dan dapat dipertanggungjawabkan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-award text-success" style="font-size: 1.5rem"></i>
                                    </div>
                                    <div>
                                        <h5>Kepercayaan Publik</h5>
                                        <p class="text-muted mb-0">
                                            Dokumen legalitas membangun kepercayaan wakif (pemberi
                                            wakaf) terhadap lembaga pengelola.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-file-earmark-text text-success" style="font-size: 1.5rem"></i>
                                    </div>
                                    <div>
                                        <h5>Kepastian Hukum</h5>
                                        <p class="text-muted mb-0">
                                            Landasan hukum yang kuat memberikan kepastian dalam
                                            operasional dan pengembangan program wakaf.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-graph-up-arrow text-success" style="font-size: 1.5rem"></i>
                                    </div>
                                    <div>
                                        <h5>Pengembangan Berkelanjutan</h5>
                                        <p class="text-muted mb-0">
                                            Legalitas memungkinkan pengelolaan wakaf yang
                                            berkelanjutan untuk kemaslahatan umat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success mt-4">
                            <h5>
                                <i class="bi bi-info-circle me-2"></i>Informasi Penting
                            </h5>
                            <p class="mb-2">
                                Semua dokumen legalitas UPW UNAND telah diverifikasi dan
                                sesuai dengan peraturan perundang-undangan yang berlaku.
                                Pengelolaan wakaf dilakukan dengan prinsip kehati-hatian,
                                transparansi, dan akuntabilitas.
                            </p>
                        </div>
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
