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
    <!-- <div class="modal fade" id="wakafUangModal" tabindex="-1" aria-labelledby="wakafUangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> {{-- Hapus modal-lg biar lebih ramping --}}
            <div class="modal-content rounded-4 border-0 shadow-lg">
                
                {{-- Header Simple --}}
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="wakafUangModalLabel">
                        <i class="bi bi-heart-fill me-2"></i>Ayo Berwakaf
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4">
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
                        <div class=" mb-1">
                            <label class="form-label fw-bold small">NIM (Opsional)</label>
                            <input type="string" name="donor_nim" class="form-control" 
                                placeholder="201152...." required>
                        </div>
                        
                        {{-- Tombol Submit --}}
                        <div class="d-grid mt-1">
                            <button type="submit" class="btn btn-success fw-bold py-2 rounded-pill">
                                Lanjut Pembayaran <i class="bi bi-arrow-right-circle ms-2"></i>
                            </button>
                        </div>
                        
                        <div class="text-center mt-1">
                            <small class="text-muted" style="font-size: 0.7rem;">
                                <i class="bi bi-lock-fill me-1"></i>Pembayaran aman
                            </small>
                        </div>
                        <div class="text-center pt-1">
                                <a href="{{ route('donations.check') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                                    <i class="bi bi-search me-1"></i> Cek Status Wakaf
                                </a>
                                <a href="{{ route('public.wakaf.history') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                                    <i class="bi-journal-text me-1"></i> Riwayat Wakaf Saya
                                </a>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <div class="modal fade" id="wakafUangModal" tabindex="-1" aria-labelledby="wakafUangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Pakai modal-lg biar kolomnya muat --}}
        <div class="modal-content rounded-4 border-0 shadow-lg">
            
            {{-- Header --}}
            <div class="modal-header bg-success text-white px-4 py-3">
                <h5 class="modal-title fw-bold" id="wakafUangModalLabel">
                    <i class="bi bi-heart-fill me-2"></i>Formulir Wakaf Cepat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 py-4">
                <form action="{{ route('donations.store') }}" method="POST">
                    @csrf
                    
                    {{-- 1. TUJUAN WAKAF --}}
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 col-form-label fw-bold small text-end-sm">Tujuan Wakaf <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="program_id" class="form-select" required>
                                <option value="">-- Pilih Program --</option>
                                @foreach($programsNav ?? [] as $p)
                                    <option value="{{ $p->id }}">{{ $p->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 2. NOMINAL --}}
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 col-form-label fw-bold small text-end-sm">Nominal (Rp) <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold">Rp</span>
                                <input type="number" name="amount" class="form-control fw-bold text-success" 
                                       placeholder="Min. 10.000" min="10000" required>
                            </div>
                        </div>
                    </div>

                    {{-- 3. NAMA LENGKAP --}}
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 col-form-label fw-bold small text-end-sm">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="donor_name" class="form-control" 
                                   placeholder="Nama atau Hamba Allah" 
                                   value="{{ auth()->check() ? auth()->user()->nama : '' }}" required>
                        </div>
                    </div>

                    {{-- 4. EMAIL --}}
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 col-form-label fw-bold small text-end-sm">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="email" name="donor_email" class="form-control" 
                                   placeholder="email@anda.com" 
                                   value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                        </div>
                    </div>

                    {{-- 5. NO HP/WA --}}
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 col-form-label fw-bold small text-end-sm">No. HP / WA <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="number" name="donor_phone" class="form-control" 
                                   placeholder="0812xxxx" maxlength="20" required>
                        </div>
                    </div>

                    {{-- 6. Kategori Wakif --}}
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 col-form-label fw-bold small text-end-sm">Kategori Wakif <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="donor_category" id="donor_category" class="form-select" required>
                                <option value="" disabled {{ old('donor_category', auth()->user()->kategori ?? '') == '' ? 'selected' : '' }}>
                                    -- Pilih Kategori --
                                </option>
                                
                                <option value="umum" {{ old('donor_category', auth()->user()->kategori ?? '') == 'umum' ? 'selected' : '' }}>
                                    Umum
                                </option>
                                <option value="mahasiswa" {{ old('donor_category', auth()->user()->kategori ?? '') == 'mahasiswa' ? 'selected' : '' }}>
                                    Mahasiswa
                                </option>
                                <option value="alumni" {{ old('donor_category', auth()->user()->kategori ?? '') == 'alumni' ? 'selected' : '' }}>
                                    Alumni
                                </option>
                                <option value="dosen" {{ old('donor_category', auth()->user()->kategori ?? '') == 'dosen' ? 'selected' : '' }}>
                                    Dosen
                                </option>
                                <option value="tenaga_pendidik" {{ old('donor_category', auth()->user()->kategori ?? '') == 'tenaga_pendidik' ? 'selected' : '' }}>
                                    Tenaga Pendidik
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- 7. Nomor Induk (OPSIONAL) --}}
                    <div class="row mb-4 align-items-center">
                        <label class="col-sm-4 col-form-label fw-bold small text-end-sm">NIM/NIP/NIKU<span class="text-muted fw-normal">(Opsional)</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="donor_nomor_induk" class="form-control" maxlength="20" >
                        </div>
                    </div>
                    
                    {{-- TOMBOL SUBMIT --}}
                    <div class="row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" class="btn btn-success w-100 fw-bold py-2 rounded-pill shadow-sm">
                                Lanjut Pembayaran <i class="bi bi-arrow-right-circle ms-2"></i>
                            </button>
                            <div class="text-center mt-2">
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    <i class="bi bi-shield-check me-1"></i>Transaksi aman & terverifikasi
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL ALTERNATIF --}}
                    <div class="row mt-4 pt-3 border-top">
                        <div class="col-12 text-center">
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('donations.check') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                    <i class="bi bi-search me-1"></i> Cek Status
                                </a>
                                <a href="{{ route('public.wakaf.history') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                    <i class="bi bi-clock-history me-1"></i> Riwayat Wakaf
                                </a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>
