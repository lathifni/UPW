<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- Title akan dinamis per halaman --}}
    <title>{{ $title ?? 'Dana Sosial UNAND' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/img/logo_unand.png') }}">

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
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}", // Ini pesan dari Middleware tadi
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oke'
            });
        @endif

        // 2. Sekalian buat pesan sukses (biar lengkap)
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#198754',
            });
        @endif
    </script>
    @stack('scripts')

    {{-- MODAL DONASI CEPAT (ULTRA MODERN & SMART AUTOFILL) --}}
    <div class="modal fade" id="wakafUangModal" tabindex="-1" aria-labelledby="wakafUangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">

                {{-- Header Modern --}}
                <div class="modal-header text-white px-4 py-3"
                    style="background: linear-gradient(135deg, #84B179 0%, #A2CB8B 100%);">
                    <h5 class="modal-title fw-bolder" id="wakafUangModalLabel">
                        <i class="bi bi-heart-pulse-fill text-danger me-2"></i> Tunaikan Kebaikan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 py-4" style="background-color: #f8faf7;">
                    <form action="{{ route('donations.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            {{-- KOLOM KIRI: PROGRAM & NOMINAL --}}
                            <div class="col-md-6 border-md-end pe-md-4">
                                <h6 class="fw-bold mb-3" style="color: #1a2e15;">1. Pilih Tujuan Wakaf</h6>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted">Program Wakaf <span
                                            class="text-danger">*</span></label>
                                    <select name="program_id" class="form-select border-success-subtle"
                                        style="border-radius: 12px;" required>
                                        <option value="">-- Pilih Program --</option>
                                        @foreach ($programsNav ?? [] as $p)
                                            <option value="{{ $p->id }}">{{ $p->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-muted">Nominal Wakaf (Rp) <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span
                                            class="input-group-text bg-white border-success-subtle border-end-0 fw-bold text-success"
                                            style="border-radius: 12px 0 0 12px;">Rp</span>
                                        <input type="number" name="amount"
                                            class="form-control border-success-subtle border-start-0 fw-bolder text-success fs-5"
                                            placeholder="10.000" min="10000" style="border-radius: 0 12px 12px 0;"
                                            required>
                                    </div>
                                </div>
                            </div>

                            {{-- KOLOM KANAN: IDENTITAS WAKIF --}}
                            <div class="col-md-6 ps-md-4">
                                <h6 class="fw-bold mb-3" style="color: #1a2e15;">2. Identitas Wakif</h6>

                                @auth
                                    {{-- JIKA SUDAH LOGIN (AUTOFILL & HIDDEN INPUT) --}}
                                    <div class="alert mb-0"
                                        style="background: rgba(132, 177, 121, 0.15); border: 1px dashed #84B179; border-radius: 16px;">
                                        <div
                                            class="d-flex align-items-center mb-3 border-bottom border-success border-opacity-25 pb-2">
                                            <i class="bi bi-patch-check-fill text-success fs-5 me-2"></i>
                                            <span class="fw-bold" style="color: #1a2e15;">Data Otomatis Terisi</span>
                                        </div>
                                        <div class="small mb-2 d-flex justify-content-between">
                                            <span class="text-muted">Nama:</span> <span
                                                class="fw-bold text-dark">{{ auth()->user()->nama }}</span>
                                        </div>
                                        <div class="small mb-2 d-flex justify-content-between">
                                            <span class="text-muted">Email:</span> <span
                                                class="fw-bold text-dark">{{ auth()->user()->email }}</span>
                                        </div>
                                        <div class="small mb-2 d-flex justify-content-between">
                                            <span class="text-muted">No. HP:</span> <span
                                                class="fw-bold text-dark">{{ auth()->user()->nomor_hp }}</span>
                                        </div>
                                        <div class="small mb-0 d-flex justify-content-between">
                                            <span class="text-muted">Kategori:</span> <span
                                                class="fw-bold text-dark text-capitalize">{{ str_replace('_', ' ', auth()->user()->kategori) }}</span>
                                        </div>
                                    </div>

                                    {{-- Input Hidden buat dikirim ke form --}}
                                    <input type="hidden" name="donor_name" value="{{ auth()->user()->nama }}">
                                    <input type="hidden" name="donor_email" value="{{ auth()->user()->email }}">
                                    <input type="hidden" name="donor_phone" value="{{ auth()->user()->nomor_hp }}">
                                    <input type="hidden" name="donor_category" value="{{ auth()->user()->kategori }}">
                                    <input type="hidden" name="donor_nomor_induk"
                                        value="{{ auth()->user()->nik ?? auth()->user()->nomor_induk }}">

                                    <div class="text-end mt-2">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="small text-danger text-decoration-none fw-bold"><i
                                                class="bi bi-box-arrow-right"></i> Ganti Akun</a>
                                    </div>
                                @else
                                    {{-- JIKA GUEST (INPUT MANUAL) --}}
                                    <div class="alert alert-warning py-2 px-3 small d-flex align-items-center mb-3"
                                        style="border-radius: 12px;">
                                        <i class="bi bi-info-circle me-2"></i> <span>Punya akun? <a
                                                href="{{ route('login') }}" class="fw-bold text-warning-emphasis">Login
                                                di sini</a></span>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label small fw-bold text-muted mb-1">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="donor_name" class="form-control form-control-sm"
                                            placeholder="Nama sesuai KTP/Identitas" style="border-radius: 8px;" required>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label small fw-bold text-muted mb-1">Alamat Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="donor_email" class="form-control form-control-sm"
                                            placeholder="email@anda.com" style="border-radius: 8px;" required>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label small fw-bold text-muted mb-1">No. HP / WhatsApp <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="donor_phone" class="form-control form-control-sm"
                                            placeholder="0812xxxx" style="border-radius: 8px;" maxlength="15" required>
                                    </div>

                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-muted mb-1">Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select name="donor_category" class="form-select form-select-sm"
                                                style="border-radius: 8px;" required>
                                                <option value="" disabled selected>Pilih...</option>
                                                <option value="umum">Umum</option>
                                                <option value="mahasiswa">Mahasiswa</option>
                                                <option value="alumni">Alumni</option>
                                                <option value="dosen">Dosen</option>
                                                <option value="tenaga_pendidik">Tenaga Pendidik</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small fw-bold text-muted mb-1">NIM/NIP/NIK <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="donor_nomor_induk"
                                                class="form-control form-control-sm" placeholder="Nomor identitas"
                                                style="border-radius: 8px;" maxlength="20" required>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>

                        {{-- FOOTER MODAL & SUBMIT --}}
                        <div class="mt-4 pt-3 border-top d-flex flex-column align-items-center">
                            <button type="submit" class="btn w-100 text-white fw-bolder py-2 mb-3"
                                style="background: #84B179; border-radius: 50px; font-size: 1.1rem; box-shadow: 0 5px 15px rgba(132, 177, 121, 0.4); transition: all 0.3s;"
                                onmouseover="this.style.transform='translateY(-2px)'"
                                onmouseout="this.style.transform='translateY(0)'">
                                Lanjutkan Pembayaran <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                            </button>

                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('donations.check') }}"
                                    class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                    <i class="bi bi-search me-1"></i> Cek Status
                                </a>
                                <a href="{{ route('public.wakaf.history') }}"
                                    class="btn btn-outline-success btn-sm rounded-pill px-3">
                                    <i class="bi bi-clock-history me-1"></i> Riwayat Wakaf
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
