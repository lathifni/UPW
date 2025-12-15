<x-layouts.app>
    <x-slot:title>Laporan & Transparansi - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            /* 1. HERO STYLE (Sesuai Request) */
            .reports-hero {
                background: linear-gradient(135deg,
                        rgba(25, 135, 84, 0.9) 0%,
                        rgba(32, 201, 151, 0.9) 100%),
                    /* Saya ganti gambarnya jadi tema dokumen/laporan biar relevan */
                    url("https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&q=80&w=1920") center/cover;
                color: white;
                padding: 100px 0;
            }

            /* 2. CARD HOVER STYLE */
            .report-card {
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .report-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
            }
        </style>
    @endpush

    {{-- HERO SECTION (Sudah pakai class .reports-hero) --}}
    <section class="reports-hero">
        <div class="container text-center position-relative z-index-1">
            <span class="badge bg-white text-success fw-bold px-3 py-2 rounded-pill mb-3 shadow-sm">
                <i class="bi bi-shield-check me-2"></i>AKUNTABILITAS PUBLIK
            </span>
            <h1 class="fw-bold display-5 mb-3">Laporan & Transparansi</h1>
            <p class="lead mx-auto text-white-50" style="max-width: 700px;">
                Sebagai wujud amanah, kami mempublikasikan laporan keuangan dan audit tahunan Dana Sosial UNAND yang dapat diakses oleh publik.
            </p>
        </div>
    </section>

    {{-- LIST FILE LAPORAN --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                
                @forelse($reports as $report)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm report-card rounded-4">
                            <div class="card-body p-4 d-flex align-items-start">
                                
                                {{-- Ikon PDF Besar --}}
                                <div class="flex-shrink-0 me-3">
                                    <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 3.5rem;"></i>
                                </div>
                                
                                {{-- Detail Laporan --}}
                                <div class="flex-grow-1">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle mb-2 px-2">
                                        Tahun {{ $report->year }}
                                    </span>
                                    
                                    <h5 class="fw-bold text-dark mb-1 lh-sm">{{ $report->title }}</h5>
                                    
                                    <small class="text-muted d-block mb-3" style="font-size: 0.8rem;">
                                        <i class="bi bi-cloud-upload me-1"></i> Diunggah {{ $report->created_at->format('d M Y') }}
                                    </small>
                                    
                                    <a href="{{ asset('storage/reports/' . $report->file_path) }}" 
                                       target="_blank"
                                       class="btn btn-outline-danger btn-sm w-100 rounded-pill fw-bold">
                                        <i class="bi bi-download me-1"></i> Unduh PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="mb-3 opacity-50">
                            <i class="bi bi-folder2-open text-muted" style="font-size: 5rem;"></i>
                        </div>
                        <h4 class="text-muted fw-bold">Belum Ada Laporan</h4>
                        <p class="text-muted">Saat ini belum ada dokumen laporan tahunan yang diunggah.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

</x-layouts.app>