<x-layouts.app>
    <x-slot:title>Pusat Edukasi Wakaf - Dana Sosial UNAND</x-slot:title>

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

            /* 1. HERO SECTION MODERN (DIKECILIN BIAR PAS) */
            .education-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.8) 100%),
                    url("https://images.unsplash.com/photo-1576764402988-7143f9cca90a?q=80&w=1920&auto=format&fit=crop") center/cover no-repeat;
                color: white;
                padding: 150px 0 80px 0;
                /* Pangkas padding biar seukuran Sejarah */
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

            /* 2. DEFINITION CARDS */
            .definition-card-modern {
                background: white;
                border-radius: 24px;
                padding: 2.5rem 2rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
                border: none;
                transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                height: 100%;
                position: relative;
                z-index: 10;
                border-bottom: 6px solid var(--c-light);
            }

            .definition-card-modern:hover {
                transform: translateY(-12px);
                box-shadow: 0 30px 60px rgba(132, 177, 121, 0.15);
                border-bottom-color: var(--c-main);
            }

            .icon-box-modern {
                width: 70px;
                height: 70px;
                background: var(--c-pale);
                color: var(--c-dark);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 2rem;
                margin: 0 auto 1.5rem;
                transition: all 0.3s;
                transform: rotate(-5deg);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            }

            .definition-card-modern:hover .icon-box-modern {
                transform: rotate(0) scale(1.1);
                background: var(--c-main);
                color: white;
            }

            /* 3. BENTO GRID KNOWLEDGE BASE */
            .knowledge-card {
                background: white;
                border-radius: 20px;
                padding: 1.5rem;
                border: 1px solid rgba(0, 0, 0, 0.03);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.02);
                transition: all 0.3s ease;
                height: 100%;
                display: flex;
                align-items: center;
                text-decoration: none !important;
            }

            .knowledge-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(132, 177, 121, 0.1);
                border-color: var(--c-main);
            }

            .k-icon-wrap {
                width: 60px;
                height: 60px;
                border-radius: 16px;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                margin-right: 1.5rem;
            }

            .k-color-1 {
                background: rgba(132, 177, 121, 0.15);
                color: var(--c-main);
            }

            .k-color-2 {
                background: rgba(255, 193, 7, 0.15);
                color: #ffc107;
            }

            .k-color-3 {
                background: rgba(13, 202, 240, 0.15);
                color: #0dcaf0;
            }

            .k-color-4 {
                background: rgba(220, 53, 69, 0.15);
                color: #dc3545;
            }

            .k-color-5 {
                background: rgba(13, 110, 253, 0.15);
                color: #0d6efd;
            }

            .k-color-6 {
                background: rgba(25, 135, 84, 0.15);
                color: #198754;
            }

            .k-color-7 {
                background: rgba(102, 16, 242, 0.15);
                color: #6610f2;
            }

            .k-color-8 {
                background: rgba(108, 117, 125, 0.15);
                color: #6c757d;
            }

            .k-title {
                font-weight: 800;
                color: var(--c-dark);
                margin-bottom: 0.25rem;
                font-size: 1.1rem;
                transition: color 0.3s;
            }

            .knowledge-card:hover .k-title {
                color: var(--c-main);
            }

            .k-desc {
                color: #6c757d;
                font-size: 0.85rem;
                margin-bottom: 0;
                line-height: 1.5;
            }

            /* 4. CTA SECTION */
            .cta-modern-box {
                background: linear-gradient(135deg, var(--c-pale) 0%, white 100%);
                border-radius: 30px;
                padding: 4rem 2rem;
                position: relative;
                overflow: hidden;
                border: 1px solid var(--c-light);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.03);
            }

            .btn-cta-modern {
                background: var(--c-main);
                color: white;
                border: none;
                padding: 1rem 2rem;
                border-radius: 50px;
                font-weight: 700;
                transition: all 0.3s;
                box-shadow: 0 10px 20px rgba(132, 177, 121, 0.3);
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .btn-cta-modern:hover {
                background: var(--c-dark);
                color: var(--c-pale);
                transform: translateY(-3px);
            }
        </style>
    @endpush

    <section class="education-hero text-center">
        <div class="hero-pattern"></div>
        <div class="position-absolute top-0 start-0 opacity-10" style="transform: translate(-10%, -10%);">
            <i class="bi bi-book" style="font-size: 20rem;"></i>
        </div>

        <div class="container position-relative z-index-1">
            <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-4 shadow-sm" data-aos="fade-down">
                <i class="bi bi-lightbulb-fill text-warning me-2"></i> PUSAT LITERASI WAKAF
            </span>
            <h1 class="display-3 fw-bolder mb-3" data-aos="fade-up" style="letter-spacing: -1px;">Kamus & Edukasi</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 750px; line-height: 1.6;" data-aos="fade-up"
                data-aos-delay="100">
                Temukan jawaban komprehensif atas pertanyaan Anda seputar hukum wakaf, manfaat, dan tata cara
                pelaksanaannya secara transparan di Universitas Andalas.
            </p>
        </div>
    </section>

    <section class="py-0 position-relative">
        <div class="container" style="margin-top: -50px;">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="definition-card-modern text-center">
                        <div class="icon-box-modern"><i class="bi bi-person-hearts"></i></div>
                        <h4 class="fw-bolder mb-3" style="color: var(--c-dark);">Wakif</h4>
                        <p class="text-muted mb-0" style="line-height: 1.6;">
                            Pihak yang mewakafkan harta bendanya. Siapapun bisa menjadi pahlawan kebaikan (Wakif), baik
                            secara perorangan maupun badan hukum/institusi.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="definition-card-modern text-center">
                        <div class="icon-box-modern"><i class="bi bi-building-check"></i></div>
                        <h4 class="fw-bolder mb-3" style="color: var(--c-dark);">Nazhir</h4>
                        <p class="text-muted mb-0" style="line-height: 1.6;">
                            Pihak yang menerima harta benda wakaf dari Wakif untuk dikelola, dijaga, dan dikembangkan
                            sesuai peruntukannya (Dalam hal ini: UPW UNAND).
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="definition-card-modern text-center">
                        <div class="icon-box-modern"><i class="bi bi-people-fill"></i></div>
                        <h4 class="fw-bolder mb-3" style="color: var(--c-dark);">Mauquf 'Alaih</h4>
                        <p class="text-muted mb-0" style="line-height: 1.6;">
                            Pihak yang ditunjuk untuk memperoleh manfaat dari hasil pengelolaan harta benda wakaf
                            (Mahasiswa penerima beasiswa, Dosen, & Masyarakat luas).
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 mt-5">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-6 fw-bolder" style="color: var(--c-dark);">Pusat Informasi Wakaf</h2>
                <p class="text-muted fs-5">Pilih topik yang ingin Anda pelajari lebih dalam.</p>
            </div>

            <div class="row g-4">

                {{-- 1. Pengertian --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('public.education.show', 'pengertian-wakaf') }}" class="knowledge-card">
                        <div class="k-icon-wrap k-color-1"><i class="bi bi-journal-text"></i></div>
                        <div>
                            <h5 class="k-title">Apa Itu Wakaf?</h5>
                            <p class="k-desc">Definisi, makna, dan syarat sah wakaf dalam kacamata Islam.</p>
                        </div>
                    </a>
                </div>

                {{-- 2. Perbedaan --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <a href="{{ route('public.education.show', 'perbedaan') }}" class="knowledge-card">
                        <div class="k-icon-wrap k-color-2"><i class="bi bi-arrow-left-right"></i></div>
                        <div>
                            <h5 class="k-title">Wakaf, Zakat & Infak?</h5>
                            <p class="k-desc">Pahami perbedaan mendasar dari ketiga instrumen filantropi ini.</p>
                        </div>
                    </a>
                </div>

                {{-- 3. Sejarah --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('public.education.show', 'sejarah-awal-mula-wakaf') }}" class="knowledge-card">
                        <div class="k-icon-wrap k-color-3"><i class="bi bi-clock-history"></i></div>
                        <div>
                            <h5 class="k-title">Sejarah Awal Wakaf</h5>
                            <p class="k-desc">Menelusuri jejak awal disyariatkannya wakaf pada zaman Nabi.</p>
                        </div>
                    </a>
                </div>

                {{-- 4. Kisah Abu Thalhah --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="250">
                    <a href="{{ route('public.education.show', 'kisah-abu-thalhah') }}" class="knowledge-card">
                        <div class="k-icon-wrap k-color-4"><i class="bi bi-heart-pulse"></i></div>
                        <div>
                            <h5 class="k-title">Kisah Abu Thalhah</h5>
                            <p class="k-desc">Kisah inspiratif sahabat Nabi mewakafkan kebun kurma terbaiknya.</p>
                        </div>
                    </a>
                </div>

                {{-- 5. Wakaf Uang --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('public.education.show', 'wakaf-uang') }}" class="knowledge-card">
                        <div class="k-icon-wrap k-color-5"><i class="bi bi-cash-coin"></i></div>
                        <div>
                            <h5 class="k-title">Konsep Wakaf Uang</h5>
                            <p class="k-desc">Memahami hukum dan kebolehan berwakaf menggunakan uang tunai.</p>
                        </div>
                    </a>
                </div>

                {{-- 6. Cara Wakaf Uang --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="350">
                    <a href="{{ route('public.education.show', 'cara-wakaf-uang') }}" class="knowledge-card">
                        <div class="k-icon-wrap k-color-6"><i class="bi bi-laptop"></i></div>
                        <div>
                            <h5 class="k-title">Cara Wakaf Uang</h5>
                            <p class="k-desc">Panduan teknis dan praktis berwakaf uang di sistem UNAND.</p>
                        </div>
                    </a>
                </div>

                {{-- 7. Beda Wakaf Uang vs Melalui Uang --}}
                <div class="col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('public.education.show', 'perbedaan-wakaf-uang-wakaf-melalui-uang') }}"
                        class="knowledge-card">
                        <div class="k-icon-wrap k-color-7"><i class="bi bi-diagram-2"></i></div>
                        <div>
                            <h5 class="k-title">Wakaf Uang vs Wakaf Melalui Uang</h5>
                            <p class="k-desc">Serupa tapi tak sama. Pahami perbedaan alokasi dan pengelolaan dari kedua
                                jenis wakaf finansial ini.</p>
                        </div>
                    </a>
                </div>

                {{-- 8. Perkembangan Wakaf --}}
                <div class="col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="450">
                    <a href="{{ route('public.education.show', 'perkembangan-wakaf') }}" class="knowledge-card">
                        <div class="k-icon-wrap k-color-8"><i class="bi bi-graph-up-arrow"></i></div>
                        <div>
                            <h5 class="k-title">Dinamika Perkembangan Wakaf</h5>
                            <p class="k-desc">Transformasi pengelolaan aset wakaf dari masa klasik hingga inovasi di
                                era modern saat ini.</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5 mb-5">
        <div class="container">
            <div class="cta-modern-box text-center" data-aos="zoom-in">
                <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(30%, -30%);">
                    <i class="bi bi-flower1 text-success" style="font-size: 20rem;"></i>
                </div>

                <div class="position-relative z-2">
                    <h2 class="display-6 fw-bolder mb-3" style="color: var(--c-dark);">Siap Menebar Kebaikan Abadi?
                    </h2>
                    <p class="fs-5 text-muted mb-5 mx-auto" style="max-width: 600px;">
                        Mari wujudkan niat baik Anda hari ini. Jadikan sebagian rezeki Anda sebagai amal jariyah yang
                        manfaatnya tidak akan pernah terputus.
                    </p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        {{-- Tambahkan text-decoration-none di sini --}}
                        <a href="{{ route('public.wakaf-uang') }}" class="btn-cta-modern text-decoration-none">
                            Wakaf Uang<i class="bi bi-arrow-right ms-2"></i>
                        </a>

                        {{-- Tambahkan text-decoration-none di sini juga --}}
                        <a href="{{ route('wakaf-melalui-uang.index.public') }}"
                            class="btn-cta-modern text-decoration-none"
                            style="background: white; color: var(--c-main); border: 2px solid var(--c-main);">
                            Wakaf Melalui Uang
                        </a>
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
