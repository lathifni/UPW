<x-layouts.dashboard>
    <x-slot:title>Sertifikat Donasi - Dana Sosial UNAND</x-slot:title>

    <x-slot:hero_content>
        <h1 class="h3 mb-2 fw-bold" style="padding-top: 70px;">Sertifikat Donasi</h1>
        <p class="mb-0 opacity-75">Bukti dan apresiasi atas kontribusi Anda untuk kemajuan pendidikan.</p>
    </x-slot:hero_content>

    @push('styles')
        <style>
            .certificate-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 1px solid #e9ecef;
                margin-bottom: 1.5rem;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .certificate-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }

            .certificate-preview {
                background: linear-gradient(135deg, #f8f9fa, #e9ecef);
                border: 2px dashed #dee2e6;
                border-radius: 1rem;
                padding: 2rem;
                text-align: center;
                min-height: 300px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
            }

            .certificate-badge {
                position: absolute;
                top: 1rem;
                right: 1rem;
                z-index: 2;
            }
        </style>
    @endpush

    <div class="row">
        {{-- Loop dinamis untuk setiap sertifikat --}}
        @forelse ($certificates as $donation)
            <div class="col-md-6 mb-4">
                <div class="certificate-card h-100">

                    {{-- Logika untuk menampilkan Tipe Dokumen --}}
                    @php
                        $docType = 'Sertifikat Standar';
                        $docIcon = 'bi-award-fill text-success';
                        $docBadge = 'bg-success';
                        if ($donation->program->certificate_type == 'akta_wakaf') {
                            $docType = 'Akta Ikrar Wakaf';
                            $docIcon = 'bi-shield-check text-primary';
                            $docBadge = 'bg-primary';
                        } elseif ($donation->program->certificate_type == 'surat_apresiasi') {
                            $docType = 'Surat Apresiasi';
                            $docIcon = 'bi-patch-check-fill text-info';
                            $docBadge = 'bg-info';
                        }
                    @endphp

                    <span class="certificate-badge badge {{ $docBadge }}">{{ $docType }}</span>

                    <div class="certificate-preview mb-3">
                        <div class="text-center">
                            <i class="bi {{ $docIcon }} display-1 mb-3"></i>
                            <h5 class="fw-bold">{{ $docType }}</h5>
                            <p class="text-muted mb-0">{{ $donation->program->title }}</p>
                        </div>
                    </div>

                    <h5 class="mb-2">{{ $donation->program->title }}</h5>
                    <p class="text-muted mb-3">
                        Diterbitkan pada {{ $donation->created_at->translatedFormat('d F Y') }} untuk donasi sebesar
                        <strong>Rp {{ number_format($donation->amount, 0, ',', '.') }}</strong>.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="{{ asset('storage/' . $donation->certificate_path) }}" target="_blank"
                            class="btn btn-success btn-sm flex-fill">
                            <i class="bi bi-download me-2"></i>Download PDF
                        </a>
                        {{-- Tombol share bisa dikembangkan nanti --}}
                        <button class="btn btn-outline-success btn-sm"><i class="bi bi-share"></i></button>
                    </div>
                </div>
            </div>

        @empty
            {{-- Tampilan jika tidak ada sertifikat sama sekali --}}
            <div class="col-md-6 mb-4">
                <div class="certificate-card h-100 d-flex align-items-center justify-content-center text-center">
                    <div>
                        <i class="bi bi-award display-1 text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Sertifikat</h5>
                        <p class="text-muted mb-3">Sertifikat akan tersedia di sini setelah donasi Anda untuk program
                            tertentu telah dikonfirmasi oleh admin.</p>
                        <a href="{{ route('programs.index.public') }}" class="btn btn-success"><i
                                class="bi bi-plus-circle me-2"></i>Donasi Sekarang</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $certificates->links() }}
    </div>

</x-layouts.dashboard>
