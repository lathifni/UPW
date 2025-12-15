<x-layouts.app>
    <x-slot:title>Instruksi Pembayaran</x-slot:title>

    <div class="container py-5" style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                {{-- KARTU INVOICE --}}
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-warning text-dark text-center py-3">
                        <h5 class="m-0 fw-bold"><i class="bi bi-clock-history me-2"></i>Menunggu Pembayaran</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        {{-- 1. Total Tagihan --}}
                        <div class="text-center mb-4">
                            <small class="text-muted text-uppercase fw-bold ls-1">Total Wakaf</small>
                            <h2 class="display-4 fw-bold text-success my-1">
                                Rp{{ number_format($donation->amount, 0, ',', '.') }}
                            </h2>

                            {{-- AREA COPY ORDER ID --}}
                            <div class="mt-3">
                                {{-- 
                                PERUBAHAN CSS:
                                1. 'd-flex' (bukan inline-flex) biar lebar menyesuaikan container
                                2. 'flex-column' (default HP: numpuk ke bawah)
                                3. 'flex-md-row' (Laptop: sejajar ke samping)
                                4. 'rounded-4' (biar bagus saat numpuk, jangan rounded-pill)
                                --}}
                                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center py-2 px-3 px-md-4 rounded-4 border border-2 bg-light position-relative copy-badge text-center" 
                                    style="cursor: pointer; border-style: dashed !important; transition: all 0.2s;"
                                    onclick="copyOrderId('{{ $donation->order_id }}')">
                                    
                                    {{-- Label: Ada margin bawah (mb-1) di HP, tapi hilang di Laptop --}}
                                    <span class="text-muted small fw-bold mb-1 mb-md-0 me-md-2 text-uppercase">
                                        Order ID:
                                    </span>
                                    
                                    {{-- ID: Font fs-5 (sedang) di HP, fs-4 (besar) di Laptop --}}
                                    {{-- text-break: Jaga-jaga kalau ID kepanjangan banget biar ga nabrak layar --}}
                                    <span class="fs-5 fs-md-4 fw-bold text-dark mb-1 mb-md-0 me-md-3 font-monospace text-break">
                                        {{ $donation->order_id }}
                                    </span>
                                    
                                    {{-- Icon Copy --}}
                                    <i class="bi bi-files fs-5 text-secondary" id="icon-copy"></i>
                                    
                                    {{-- Tooltip "Tersalin" --}}
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark" 
                                        id="copied-tooltip" style="display: none;">
                                        Tersalin!
                                    </span>
                                </div>
                                
                                <div class="small text-muted mt-1 fst-italic" style="font-size: 0.8rem;">
                                    <i class="bi bi-hand-index-thumb"></i> Klik kode di atas untuk menyalin
                                </div>
                            </div>
                        </div>

                        {{-- 2. Area QRIS --}}
                        <div class="text-center border rounded p-3 mb-4 bg-light">
                            
                            {{-- LOGIC GANTI JUDUL --}}
                            <p class="mb-2 fw-bold">
                                @if($donation->program_id == 1)
                                    Scan QRIS Wakaf Uang (Dana Abadi):
                                @else
                                    Scan QRIS Donasi Program:
                                @endif
                            </p>

                            {{-- LOGIC GANTI GAMBAR --}}
                            <img src="{{ $donation->program_id == 1 ? asset('frontend/img/up-wakaf-unand.jpeg') : asset('frontend/img/wakaf-unand(bank-nagari).jpeg') }}" 
                                alt="QRIS Code" 
                                {{-- w-100: Lebar 100% dari container --}}
                                {{-- h-auto: Tinggi otomatis biar proporsional --}}
                                class="img-fluid rounded border bg-white p-2 w-100 h-auto" 
                                {{-- style="max-width: 400px;" agar di layar besar dia gak terlalu raksasa --}}
                                style="max-width: 400px; object-fit: contain;">

                            {{-- LOGIC GANTI KETERANGAN BAWAH (Opsional) --}}
                            <p class="small text-muted mt-2 mb-0">
                                @if($donation->program_id == 1)
                                    Rekening Khusus Pengelolaan Wakaf Uang
                                @else
                                    Rekening Penampungan Donasi Program
                                @endif
                            </p>

                        </div>

                        {{-- 3. Instruksi --}}
                        <div class="alert alert-info border-0 d-flex align-items-start" role="alert">
                            <i class="bi bi-info-circle-fill me-2 mt-1"></i>
                            <div class="small">
                                Setelah melakukan pembayaran, sistem akan memverifikasi otomatis dalam 1x24 jam (atau manual oleh Admin). 
                                <br><strong>Simpan Order ID Anda untuk pengecekan.</strong>
                            </div>
                        </div>

                        {{-- 4. Tombol Aksi --}}
                        <div class="d-grid gap-2">
                            {{-- Tombol Konfirmasi WA (Opsional tapi berguna banget) --}}
                            <a href="https://wa.me/6281234567890?text=Assalamualaikum,%20saya%20sudah%20wakaf%20dengan%20Order%20ID:%20{{ $donation->order_id }}" 
                               target="_blank" class="btn btn-success fw-bold">
                                <i class="bi bi-whatsapp me-2"></i> Konfirmasi ke Admin
                            </a>
                            
                            <a href="{{ route('donations.check') }}" class="btn btn-outline-secondary">
                                Cek Status Pembayaran
                            </a>
                        </div>

                    </div>
                    <div class="card-footer bg-light text-center py-3">
                        <small class="text-muted">Terima kasih atas kontribusi Anda</small>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>