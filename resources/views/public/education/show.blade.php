<x-layouts.app>
    <x-slot:title>{{ $post->title }} - Edukasi Wakaf UNAND</x-slot:title>

    @push('styles')
        <style>
            :root {
                --c-main: #84B179;
                --c-hover: #A2CB8B;
                --c-light: #C7EABB;
                --c-pale: #E8F5BD;
                --c-dark: #1a2e15;
            }

            body {
                background-color: #f8faf7;
            }

            /* 1. HERO ARTICLE MODERN (Gradasi Estetik) */
            .edu-hero {
                /* Gradasi linear dari hijau tua ke teal, denganpattern abstrak */
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.95) 0%, rgba(32, 201, 151, 0.9) 100%),
                    url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2v-4h4v-2h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2v-4h4v-2H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                color: white;
                padding: 180px 0 120px 0;
                position: relative;
            }

            /* 2. META GLASS CARD (Navigasi Floating) */
            .meta-glass-card {
                background: white;
                border-radius: 20px;
                padding: 1.5rem 2.5rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
                margin-top: -40px;
                position: relative;
                z-index: 10;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .btn-back-modern {
                background: var(--c-pale);
                color: var(--c-dark);
                padding: 0.6rem 1.5rem;
                border-radius: 50px;
                font-weight: 700;
                transition: all 0.3s;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
            }

            .btn-back-modern:hover {
                background: var(--c-main);
                color: white;
                transform: translateX(-5px);
            }

            /* 3. TYPOGRAPHY CONTENT (Legar & Bersih) */
            .article-content-modern {
                font-size: 1.15rem;
                line-height: 1.9;
                color: #334155;
                margin-top: 2rem;
            }

            .article-content-modern p {
                margin-bottom: 1.5rem;
            }

            .article-content-modern h2,
            .article-content-modern h3,
            .article-content-modern h4 {
                color: var(--c-dark);
                font-weight: 800;
                margin-top: 3rem;
                margin-bottom: 1rem;
            }

            .article-content-modern ul,
            .article-content-modern ol {
                margin-bottom: 1.5rem;
                padding-left: 1.5rem;
            }

            .article-content-modern li {
                margin-bottom: 0.5rem;
            }

            .article-content-modern strong {
                color: var(--c-dark);
                font-weight: 700;
            }

            /* Custom Blockquote */
            .article-content-modern blockquote {
                border-left: 5px solid var(--c-main);
                background: var(--c-pale);
                padding: 1.5rem 2rem;
                border-radius: 0 16px 16px 0;
                font-style: italic;
                color: var(--c-dark);
                font-size: 1.25rem;
                font-weight: 600;
                margin: 2.5rem 0;
            }

            /* Custom Images inside content (kalau ada) */
            .article-content-modern img {
                border-radius: 16px;
                margin: 2.5rem 0;
                width: 100%;
                height: auto;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            }

            /* 4. CTA AFTER CONTENT */
            .cta-after-content {
                background: linear-gradient(135deg, rgba(132, 177, 121, 0.1) 0%, rgba(232, 245, 189, 0.5) 100%);
                border: 2px dashed var(--c-main);
                border-radius: 24px;
                padding: 2.5rem;
                text-align: center;
                margin-bottom: 50px;
            }

            .btn-cta-small {
                background: var(--c-main);
                color: white;
                border: none;
                padding: 0.8rem 2rem;
                border-radius: 50px;
                font-weight: 700;
                transition: all 0.3s;
                text-decoration: none;
                box-shadow: 0 10px 20px rgba(132, 177, 121, 0.3);
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .btn-cta-small:hover {
                background: var(--c-dark);
                color: var(--c-pale);
                transform: translateY(-3px);
            }
        </style>
    @endpush

    <section class="edu-hero" data-aos="fade-in">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9" data-aos="fade-up" data-aos-delay="100">
                    <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-4 shadow-sm">
                        <i class="bi bi-journal-bookmark-fill text-warning me-2"></i> PUSAT LITERASI WAKAF
                    </span>
                    <h1 class="display-4 fw-bolder mb-0" style="line-height: 1.2;">{{ $post->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container mb-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                {{-- FLOATING NAV & META --}}
                <div class="meta-glass-card" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('public.education.index') }}" class="btn-back-modern">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Edukasi
                    </a>
                    <div class="text-muted fw-bold small mt-3 mt-sm-0">
                        <i class="bi bi-calendar-event text-success me-1"></i> Diperbarui: {{ $post->date }}
                    </div>
                </div>

                {{-- ISI KONTEN (Panggil file dari folder contents) --}}
                <article class="article-content-modern py-4" data-aos="fade-in" data-aos-delay="300">
                    @include($post->view_file)
                </article>

                {{-- CTA DONASI SETELAH BACA --}}
                <div class="cta-after-content mt-5" data-aos="zoom-in" data-aos-offset="100">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white text-success rounded-circle mb-3 shadow-sm"
                        style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h4 class="fw-bold" style="color: var(--c-dark);">Tertarik untuk Mewujudkan Niat Baik?</h4>
                    <p class="text-muted mb-4">Jadikan pemahaman yang baru Anda baca sebagai langkah nyata. Tunaikan
                        wakaf Anda sekarang dan biarkan pahalanya mengalir abadi.</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a href="{{ route('public.wakaf-uang') }}" class="btn-cta-small">
                            Mulai Wakaf Uang
                        </a>
                        <a href="{{ route('wakaf-melalui-uang.index.public') }}" class="btn-cta-small"
                            style="background: white; color: var(--c-main); border: 2px solid var(--c-main); box-shadow: none;">
                            Pilih Project Wakaf
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Initialize AOS jika belum dipanggil terpisah
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
