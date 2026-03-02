<x-layouts.dashboard>
    <x-slot:title>Sertifikat Donasi - Dana Sosial UNAND</x-slot:title>

    <x-slot:hero_content>
        <h1 class="h3 mb-2 fw-bold" style="padding-top: 70px;">Sertifikat Donasi</h1>
        <p class="mb-0 opacity-75">Bukti dan apresiasi atas kontribusi Anda untuk kemajuan pendidikan.</p>
    </x-slot:hero_content>

    @push('styles')
        <style>
            /* LIST STYLE DASHBOARD */
            .certificate-list-item {
                background: white;
                border-radius: 12px;
                padding: 1.25rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
                border: 1px solid #e9ecef;
                margin-bottom: 1rem;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                gap: 1.5rem;
            }

            .certificate-list-item:hover {
                transform: translateX(5px);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
                border-color: #198754;
            }

            /* Icon area in list */
            .cert-icon-wrapper {
                width: 60px;
                height: 60px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.75rem;
                flex-shrink: 0;
            }

            /* Main content area */
            .cert-content {
                flex-grow: 1;
                min-width: 0;
                /* Mencegah overflow pada flex item */
            }

            /* Action buttons area */
            .cert-actions {
                flex-shrink: 0;
                display: flex;
                gap: 0.5rem;
            }

            /* Responsiveness for mobile */
            @media (max-width: 768px) {
                .certificate-list-item {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1rem;
                }

                .cert-actions {
                    width: 100%;
                    justify-content: flex-start;
                }

                .cert-actions .btn {
                    flex-grow: 1;
                }
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-12">

            {{-- Loop dinamis untuk setiap sertifikat dalam bentuk list --}}
            @forelse ($certificates as $donation)
                @php
                    $docType = 'Sertifikat Standar';
                    $docIcon = 'bi-award-fill text-success';
                    $docBg = 'bg-success bg-opacity-10';
                    $docBadge = 'text-bg-success';

                    if ($donation->program->certificate_type == 'akta_wakaf') {
                        $docType = 'Akta Ikrar Wakaf';
                        $docIcon = 'bi-shield-check text-primary';
                        $docBg = 'bg-primary bg-opacity-10';
                        $docBadge = 'text-bg-primary';
                    } elseif ($donation->program->certificate_type == 'surat_apresiasi') {
                        $docType = 'Surat Apresiasi';
                        $docIcon = 'bi-patch-check-fill text-info';
                        $docBg = 'bg-info bg-opacity-10';
                        $docBadge = 'text-bg-info';
                    }
                @endphp

                <div class="certificate-list-item">
                    {{-- 1. Ikon Dokumen --}}
                    <div class="cert-icon-wrapper {{ $docBg }}">
                        <i class="bi {{ $docIcon }}"></i>
                    </div>

                    {{-- 2. Info Dokumen --}}
                    <div class="cert-content">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h5 class="mb-0 fw-bold text-truncate" title="{{ $donation->program->title }}">
                                {{ $donation->program->title }}
                            </h5>
                            <span class="badge {{ $docBadge }} small px-2 py-1">{{ $docType }}</span>
                        </div>

                        <p class="text-muted small mb-0">
                            <i class="bi bi-calendar-check me-1"></i> Diterbitkan:
                            {{ $donation->created_at->translatedFormat('d F Y') }}
                            <span class="mx-2 text-black-50">|</span>
                            <i class="bi bi-cash-coin me-1"></i> Nominal: <strong>Rp
                                {{ number_format($donation->amount, 0, ',', '.') }}</strong>
                        </p>
                    </div>

                    {{-- 3. Tombol Aksi --}}
                    <div class="cert-actions">
                        <a href="{{ asset('storage/' . $donation->certificate_path) }}" target="_blank"
                            class="btn btn-success btn-sm px-3">
                            <i class="bi bi-download me-1"></i> Unduh
                        </a>
                    </div>
                </div>

            @empty
                {{-- Tampilan Kosong (Tetap pakai box luas biar kelihatan) --}}
                <div class="card border-0 shadow-sm rounded-4 mt-3">
                    <div class="card-body text-center py-5">
                        <div class="d-inline-block p-4 rounded-circle mb-3 bg-light text-muted">
                            <i class="bi bi-award display-4"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Belum Ada Sertifikat</h5>
                        <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">
                            Sertifikat akan tersedia di sini setelah donasi Anda untuk program tertentu telah
                            dikonfirmasi oleh admin.
                        </p>
                        <a href="{{ route('public.wakaf-uang') }}" class="btn btn-success px-4 rounded-pill">
                            <i class="bi bi-plus-circle me-2"></i>Mulai Berwakaf
                        </a>
                    </div>
                </div>
            @endforelse

        </div>
    </div>

    {{-- Paginasi --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $certificates->links() }}
    </div>

</x-layouts.dashboard>
