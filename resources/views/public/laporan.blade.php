<x-layouts.app>
    <x-slot:title>Laporan & Transparansi - Dana Sosial UNAND</x-slot:title>

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

            /* HERO SECTION MODERN (DIKECILIN BIAR PAS) */
            .reports-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.85) 100%),
                    url("https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&q=80&w=1920") center/cover no-repeat;
                color: white;
                padding: 150px 0 80px 0;
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

            /* CARD REPORT MODERN */
            .report-card-modern {
                background: white;
                border-radius: 20px;
                padding: 2rem;
                border: 1px solid rgba(0, 0, 0, 0.03);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
                transition: all 0.4s ease;
                display: flex;
                align-items: flex-start;
                height: 100%;
                position: relative;
                overflow: hidden;
            }

            .report-card-modern:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(132, 177, 121, 0.15);
                border-color: var(--c-light);
            }

            /* Aksen dekoratif di sudut card */
            .report-card-modern::before {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                width: 60px;
                height: 60px;
                background: var(--c-pale);
                border-radius: 0 0 0 100%;
                opacity: 0.5;
                transition: all 0.4s ease;
            }

            .report-card-modern:hover::before {
                transform: scale(1.5);
                background: var(--c-light);
                opacity: 0.3;
            }

            /* Ikon PDF */
            .icon-pdf-wrapper {
                width: 70px;
                height: 70px;
                border-radius: 16px;
                background: rgba(220, 53, 69, 0.1);
                color: #dc3545;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                margin-right: 1.5rem;
                transition: all 0.3s;
            }

            .report-card-modern:hover .icon-pdf-wrapper {
                background: #dc3545;
                color: white;
            }

            /* Tombol Unduh */
            .btn-download-modern {
                border: 2px solid var(--c-pale);
                color: var(--c-dark);
                border-radius: 50px;
                padding: 0.6rem 1.5rem;
                font-weight: 700;
                transition: all 0.3s ease;
                display: inline-block;
                text-align: center;
                width: 100%;
                margin-top: 1rem;
            }

            .btn-download-modern:hover {
                background: var(--c-main);
                border-color: var(--c-main);
                color: white;
                box-shadow: 0 8px 15px rgba(132, 177, 121, 0.3);
            }

            /* Class Utility untuk mendorong footer */
            .content-wrapper {
                min-height: 50vh;
                /* Memastikan tinggi minimal biar footer gak naik */
                margin-top: -40px;
                position: relative;
                z-index: 5;
                padding-bottom: 5rem;
                /* Memberi jeda napas antara konten terakhir dan footer */
            }
        </style>
    @endpush

    <section class="reports-hero">
        <div class="hero-pattern"></div>
        <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(10%, -10%);">
            <i class="bi bi-file-earmark-bar-graph" style="font-size: 20rem;"></i>
        </div>

        <div class="container text-center position-relative z-index-1">
            <span class="badge bg-white text-success fw-bold px-3 py-2 rounded-pill mb-4 shadow-sm" data-aos="fade-down">
                <i class="bi bi-shield-check me-2"></i>AKUNTABILITAS PUBLIK
            </span>
            <h1 class="fw-bolder display-4 mb-4" data-aos="fade-up">Laporan & Transparansi</h1>
            <p class="lead mx-auto text-white-50" style="max-width: 750px; line-height: 1.6;" data-aos="fade-up"
                data-aos-delay="100">
                Sebagai wujud amanah dan profesionalisme, kami secara berkala mempublikasikan laporan keuangan dan hasil
                audit pengelolaan Dana Sosial Universitas Andalas.
            </p>
        </div>
    </section>

    <main class="content-wrapper">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">

                @forelse($reports as $report)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <article class="report-card-modern">

                            <div class="icon-pdf-wrapper" aria-hidden="true">
                                <i class="bi bi-file-earmark-pdf-fill fs-1"></i>
                            </div>

                            <div class="flex-grow-1 position-relative z-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge px-3 py-1 rounded-pill"
                                        style="background: var(--c-dark); color: white;">
                                        Tahun {{ $report->year }}
                                    </span>
                                </div>

                                <h2 class="fw-bolder text-dark mb-2 h5" style="line-height: 1.4;">{{ $report->title }}
                                </h2>

                                <div class="text-muted small mb-3">
                                    <i class="bi bi-clock me-1"></i> Diunggah <time
                                        datetime="{{ $report->created_at->format('Y-m-d') }}">{{ $report->created_at->format('d M Y') }}</time>
                                </div>

                                <a href="{{ asset('storage/reports/' . $report->file_path) }}" target="_blank"
                                    class="btn-download-modern text-decoration-none"
                                    title="Unduh Laporan {{ $report->title }}"
                                    aria-label="Unduh dokumen PDF untuk {{ $report->title }}">
                                    <i class="bi bi-cloud-arrow-down-fill me-2"></i> Unduh PDF
                                </a>
                            </div>

                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 my-5">
                        <div class="d-inline-block p-5 rounded-circle mb-4" style="background: var(--c-pale);">
                            <i class="bi bi-folder-x text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h2 class="fw-bolder h3" style="color: var(--c-dark);">Belum Ada Laporan</h2>
                        <p class="text-muted fs-5">Dokumen laporan tahunan sedang dalam tahap penyusunan dan akan segera
                            diunggah.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            // Initialize AOS (Bila dipanggil terpisah)
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
