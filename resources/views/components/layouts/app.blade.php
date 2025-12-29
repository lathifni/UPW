<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- Title akan dinamis per halaman --}}
    <title>{{ $title ?? 'Dana Sosial UNAND' }}</title>
    <link rel="icon" type="image/x-icon" src="{{ asset('frontend/img/logo_unand.png') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" />

    {{-- Slot untuk CSS tambahan khusus per halaman --}}
    @stack('styles')
</head>

<body>
    <x-partials.navbar />

    <main>
        {{ $slot }}
    </main>

    <x-partials.footer />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarWrapper = document.querySelector('.navbar-wrapper');
            if (navbarWrapper) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbarWrapper.classList.add('scrolled');
                    } else {
                        navbarWrapper.classList.remove('scrolled');
                    }
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // 1. Cek apakah ada session bernama 'error' dari Backend?
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}", // Ini pesan dari Middleware tadi
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oke'
            });
        @endif

        // 2. Sekalian buat pesan sukses (biar lengkap)
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#198754',
            });
        @endif
    </script>
    @stack('scripts')

    <!-- <div class="modal fade" id="wakafUangModal" tabindex="-1" aria-labelledby="wakafUangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Pakai modal-lg biar agak lebar --}}
            <div class="modal-content rounded-4 border-0 overflow-hidden shadow-lg">
                
                {{-- Header Modal dengan Background Hijau --}}
                <div class="modal-header bg-success text-white p-4">
                    <h5 class="modal-title fw-bold" id="wakafUangModalLabel">
                        <i class="bi bi-cash-coin me-2"></i>Wakaf Uang (Tunai)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-0">
                    <div class="row g-0 h-100">
                        
                        {{-- KOLOM KIRI: Gambar QRIS & Instruksi --}}
                        <div class="col-md-5 bg-light text-center p-4 border-end">
                            <h6 class="fw-bold mb-3 text-success">Scan QRIS untuk Berwakaf</h6>
                            
                            {{-- Container Gambar QRIS --}}
                            <div class="bg-white p-3 rounded-3 shadow-sm d-inline-block mb-3 border">
                                {{-- GANTI path gambar ini sesuai lokasi gambar QRIS kamu --}}
                                <img src="{{ asset('frontend/img/qris-unand.jpg') }}" 
                                    alt="QRIS Dana Sosial UNAND" 
                                    class="img-fluid" 
                                    style="max-width: 200px; height: auto;">
                            </div>
                            
                            <p class="small text-muted mb-1">A.n. Dana Sosial UNAND</p>
                            <p class="small fw-bold text-dark mb-3">NMID: ID1234567890 (Contoh)</p>

                            <div class="alert alert-warning small text-start fst-italic">
                                <i class="bi bi-info-circle me-1"></i>
                                Silakan scan dan transfer sesuai nominal yang Anda inginkan. Setelah berhasil, mohon isi formulir konfirmasi di samping.
                            </div>
                        </div>

                        {{-- KOLOM KANAN: Formulir Konfirmasi --}}
                        <div class="col-md-7 p-4">
                            <h6 class="fw-bold mb-4">Konfirmasi Wakaf Anda</h6>
                            
                            {{-- Form mengarah ke route yang menangani penyimpanan donasi --}}
                            {{-- Pastikan kamu sudah punya route dan controller untuk ini (mirip storeManual di admin tapi untuk publik) --}}
                            <form action="{{ route('public.wakaf.store') }}" method="POST">
                                @csrf
                                {{-- Hidden input untuk menandakan ini Wakaf Uang --}}
                                <input type="hidden" name="donation_type" value="wakaf_uang_kilat">

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Nama Wakif (Donatur) <span class="text-danger">*</span></label>
                                    <input type="text" name="donor_name" class="form-control" placeholder="Nama Lengkap / Hamba Allah" required value="{{ auth()->check() ? auth()->user()->nama : '' }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="donor_email" class="form-control" placeholder="email@anda.com" required value="{{ auth()->check() ? auth()->user()->email : '' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">No. WhatsApp <span class="text-danger">*</span></label>
                                        <input type="text" name="donor_phone" class="form-control" placeholder="0812xxxx" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Nominal yang Ditransfer (Rp) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-white fw-bold">Rp</span>
                                        <input type="number" name="amount" class="form-control fw-bold text-success" placeholder="Contoh: 100000" min="10000" required>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">Minimal Rp 10.000</small>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success fw-bold py-2">
                                        <i class="bi bi-send-check me-2"></i>Saya Sudah Transfer & Konfirmasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="modal fade" id="wakafUangModal" tabindex="-1" aria-labelledby="wakafUangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> {{-- Hapus modal-lg biar lebih ramping --}}
            <div class="modal-content rounded-4 border-0 shadow-lg">
                
                {{-- Header Simple --}}
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="wakafUangModalLabel">
                        <i class="bi bi-heart-fill me-2"></i>Ayo Berwakaf
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    {{-- Form diarahkan ke Route Donasi Online (Midtrans) --}}
                    {{-- Ganti 'donations.store' dengan route yang kamu pakai di halaman detail program --}}
                    <form action="{{ route('donations.store') }}" method="POST">
                        @csrf
                        
                        {{-- 1. PILIH TUJUAN WAKAF (Dropdown) --}}
                        <div class="mb-1">
                            <label class="form-label fw-bold small">Saya Ingin Berwakaf Untuk:</label>
                            <select name="program_id" class="form-select" required>
                                <option value="">-- Pilih Program Wakaf --</option>
                                
                                {{-- Opsi Khusus Wakaf Uang (Jika ada ID khususnya, misal ID 1) --}}
                                {{-- <option value="1">Wakaf Uang Abadi (Dana Abadi)</option> --}}

                                {{-- Looping Program dari Database --}}
                                @foreach($programsNav ?? [] as $p)
                                    <option value="{{ $p->id }}">{{ $p->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- 2. NOMINAL --}}
                        <div class="mb-1">
                            <label class="form-label fw-bold small">Nominal Wakaf (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold">Rp</span>
                                <input type="number" name="amount" class="form-control fw-bold text-success" 
                                    placeholder="Minimal 10.000" min="10000" required>
                            </div>
                        </div>

                        {{-- 3. DATA DIRI --}}
                        <div class="mb-1">
                            <label class="form-label fw-bold small">Nama Lengkap</label>
                            <input type="text" name="donor_name" class="form-control" 
                                placeholder="Nama atau Hamba Allah" 
                                value="{{ auth()->check() ? auth()->user()->nama : '' }}" required>
                        </div>

                        <div class=" mb-1">
                            <label class="form-label fw-bold small">Email</label>
                            <input type="email" name="donor_email" class="form-control" 
                                placeholder="email@anda.com" 
                                value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                        </div>
                        <div class=" mb-1">
                            <label class="form-label fw-bold small">No HP/WA Aktif</label>
                            <input type="number" name="donor_phone" class="form-control" 
                                placeholder="0812..." required>
                        </div>
                        
                        {{-- Tombol Submit --}}
                        <div class="d-grid mt-2">
                            <button type="submit" class="btn btn-success fw-bold py-2 rounded-pill">
                                Lanjut Pembayaran <i class="bi bi-arrow-right-circle ms-2"></i>
                            </button>
                        </div>
                        
                        <div class="text-center mt-1">
                            <small class="text-muted" style="font-size: 0.7rem;">
                                <i class="bi bi-lock-fill me-1"></i>Pembayaran aman
                            </small>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
