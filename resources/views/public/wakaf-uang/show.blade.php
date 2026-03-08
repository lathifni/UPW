<x-layouts.app>
    <x-slot:title>Wakaf Uang Abadi - Dana Sosial UNAND</x-slot:title>

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

            /* HERO SECTION MODERN */
            .wakaf-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.8) 100%),
                    url("{{ $program->image ? asset('storage/programs/' . $program->image) : 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?auto=format&fit=crop&q=80&w=1920' }}") center/cover no-repeat;
                color: white;
                padding: 140px 0 100px 0;
                /* Padding atas digedein biar nggak ketutup navbar */
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

            /* GLASS SALDO CARD */
            .saldo-glass-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 24px;
                padding: 2rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                display: inline-block;
                transform: translateY(20px);
                animation: floatUp 0.8s ease forwards;
            }

            @keyframes floatUp {
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            /* FORM CARD MODERN */
            .form-glass-card {
                background: white;
                border-radius: 24px;
                box-shadow: 0 20px 40px rgba(132, 177, 121, 0.15);
                border: none;
                overflow: hidden;
                position: sticky;
                top: 100px;
                /* Bikin form ngikutin pas di scroll */
                z-index: 10;
            }

            .form-header-modern {
                background: var(--c-main);
                color: white;
                padding: 1.5rem;
                text-align: center;
            }

            /* BUTTONS & INPUTS */
            .btn-nominal-modern {
                border: 2px solid var(--c-light);
                color: var(--c-dark);
                border-radius: 12px;
                font-weight: 700;
                transition: all 0.3s;
                background: transparent;
            }

            .btn-nominal-modern:hover {
                border-color: var(--c-main);
                color: var(--c-main);
                background: var(--c-pale);
            }

            .btn-nominal-modern.active {
                background: var(--c-main);
                border-color: var(--c-main);
                color: white;
                box-shadow: 0 5px 15px rgba(132, 177, 121, 0.3);
            }

            .input-modern {
                border: 2px solid #e3e8e3;
                border-radius: 12px;
                padding: 0.8rem 1rem;
                transition: all 0.3s;
            }

            .input-modern:focus {
                border-color: var(--c-main);
                box-shadow: 0 0 0 4px rgba(132, 177, 121, 0.1);
                outline: none;
            }

            .btn-donate-huge {
                background: linear-gradient(135deg, var(--c-main) 0%, var(--c-hover) 100%);
                color: white;
                border: none;
                border-radius: 16px;
                padding: 1.2rem;
                font-size: 1.2rem;
                font-weight: 800;
                box-shadow: 0 10px 20px rgba(132, 177, 121, 0.3);
                transition: all 0.3s;
            }

            .btn-donate-huge:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 25px rgba(132, 177, 121, 0.4);
                color: white;
            }

            /* LIST DONATUR */
            .donor-item {
                transition: all 0.3s;
                border-radius: 16px;
                margin-bottom: 0.5rem;
                border: 1px solid transparent;
            }

            .donor-item:hover {
                background: var(--c-pale);
                border-color: var(--c-light);
                transform: translateX(5px);
            }
        </style>
    @endpush

    {{-- HERO SECTION --}}
    <section class="wakaf-hero">
        <div class="hero-pattern"></div>
        <div class="position-absolute top-0 end-0 opacity-25" style="transform: translate(20%, -10%) rotate(-15deg);">
            <i class="bi bi-piggy-bank" style="font-size: 25rem; color: rgba(255,255,255,0.4);"></i>
        </div>

        <div class="container position-relative z-index-1 text-center">
            <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">Wakaf Uang
                Universitas Andalas</span>
            <h1 class="display-3 fw-bolder mb-3 text-white" style="letter-spacing: -1px;">{{ $program->title }}</h1>
            <p class="fs-5 mb-5 text-white-50 mx-auto" style="max-width: 700px; line-height: 1.6;">
                Wujudkan kebaikan yang pokoknya terjaga secara abadi. Amal jariyah yang manfaatnya tidak akan pernah
                terputus selamanya.
            </p>

            <div class="saldo-glass-card">
                <p class="text-uppercase text-white-50 fw-bold mb-1" style="letter-spacing: 2px; font-size: 0.85rem;">
                    Total Dana Terkelola</p>
                <h2 class="display-4 fw-bolder text-white mb-0" style="text-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    Rp {{ number_format($totalFunds, 0, ',', '.') }}
                </h2>
                <div class="d-inline-flex align-items-center mt-3 px-3 py-1 rounded-pill"
                    style="background: rgba(255,255,255,0.2);">
                    <span class="spinner-grow spinner-grow-sm text-light me-2"
                        style="width: 10px; height: 10px;"></span>
                    <small class="fw-bold text-white">Update Realtime</small>
                </div>
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT (LAYOUT 7 - 5 GRID) --}}
    <div class="container py-5" style="margin-top: -30px; position: relative; z-index: 5;">
        <div class="row g-5">

            {{-- KIRI: Deskripsi & Grafik (7 Kolom) --}}
            <div class="col-lg-7">

                {{-- Card Grafik Pertumbuhan --}}
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                    <div class="card-header bg-white py-3 border-0 d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold m-0" style="color: var(--c-dark);">
                            <i class="bi bi-graph-up-arrow text-success me-2"></i> Grafik Pertumbuhan
                        </h5>
                    </div>
                    <div class="card-body p-4 bg-light">
                        <div style="height: 300px; position: relative;">
                            <canvas id="wakafChart"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Artikel Deskripsi --}}
                <div class="mb-5 px-lg-3">
                    <h3 class="fw-bolder mb-4" style="color: var(--c-dark);">Tentang Program Ini</h3>
                    <div class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">
                        {!! nl2br(e($program->description)) !!}
                    </div>
                </div>

                {{-- List Donatur Terbaru (Pindah ke kiri bawah form donasi) --}}
                @if ($latestDonors->count() > 0)
                    <div class="mt-5 pt-4 border-top">
                        <h4 class="fw-bold mb-4" style="color: var(--c-dark);">
                            <i class="bi bi-people-fill text-success me-2"></i> Orang Baik Terbaru
                        </h4>
                        <div class="d-flex flex-column gap-2">
                            @foreach ($latestDonors as $donor)
                                <div class="donor-item d-flex align-items-center p-3 bg-white shadow-sm">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold fs-5 shadow-sm"
                                        style="width: 50px; height: 50px; background: var(--c-pale); color: var(--c-dark);">
                                        {{ substr($donor->donor_name, 0, 1) }}
                                    </div>
                                    <div class="ms-3 flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="mb-0 fw-bold" style="color: var(--c-dark);">
                                                {{ Str::mask($donor->donor_name, '*', 4) }}</h6>
                                            <span
                                                class="badge bg-light text-muted fw-normal">{{ $donor->created_at?->diffForHumans() }}</span>
                                        </div>
                                        <div class="text-success fw-bold">Rp
                                            {{ number_format($donor->amount, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- KANAN: Form Donasi (5 Kolom - Sticky) --}}
            <div class="col-lg-5">
                <div id="form-wakaf-area" class="form-glass-card">
                    <div class="form-header-modern">
                        <h4 class="fw-bolder m-0"><i class="bi bi-heart-fill me-2 text-warning"></i> Mulai Berwakaf</h4>
                        <p class="small opacity-75 mb-0 mt-1">Pilih nominal dan isi data diri Anda</p>
                    </div>

                    <div class="p-4 p-md-5 bg-white">
                        <form action="{{ route('donations.store') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="program_id" value="{{ $program->id }}">
                            <input type="hidden" name="amount" id="amount_hidden">

                            {{-- Pilihan Nominal Cepat --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold text-muted small text-uppercase">Pilih Nominal
                                    Cepat</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button type="button" class="btn w-100 btn-nominal-modern"
                                            data-value="100000">Rp 100.000</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn w-100 btn-nominal-modern"
                                            data-value="250000">Rp 250.000</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn w-100 btn-nominal-modern"
                                            data-value="500000">Rp 500.000</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn w-100 btn-nominal-modern"
                                            data-value="1000000">Rp 1 Juta</button>
                                    </div>
                                </div>
                            </div>

                            {{-- Input Nominal Manual --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold text-muted small text-uppercase">Atau Nominal
                                    Lainnya</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 fw-bold px-3">Rp</span>
                                    <input type="number"
                                        class="form-control form-control-lg input-modern border-start-0 fw-bold fs-4 text-success"
                                        id="customAmount" placeholder="0" min="10000">
                                </div>
                                <small class="text-danger mt-1 d-none" id="minAmountWarning">*Minimal donasi Rp
                                    10.000</small>
                            </div>

                            <hr class="my-4 opacity-10">

                            {{-- Data Diri Section --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold text-muted small text-uppercase mb-3">Informasi
                                    Wakif</label>

                                @auth
                                    <div class="bg-pale-custom rounded-4 p-3 mb-3 border border-success border-opacity-25">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-patch-check-fill text-success fs-5 me-2"></i>
                                            <span class="fw-bold" style="color: var(--c-dark);">Terhubung sebagai:</span>
                                        </div>
                                        <h5 class="fw-bolder mb-1">{{ auth()->user()->nama }}</h5>
                                        <p class="mb-0 text-muted small">{{ auth()->user()->email }} |
                                            {{ auth()->user()->nomor_hp }}</p>

                                        <input type="hidden" name="donor_name" value="{{ auth()->user()->nama }}">
                                        <input type="hidden" name="donor_email" value="{{ auth()->user()->email }}">
                                        <input type="hidden" name="donor_phone" value="{{ auth()->user()->nomor_hp }}">
                                        <input type="hidden" name="donor_category"
                                            value="{{ auth()->user()->kategori }}">
                                        <input type="hidden" name="donor_nomor_induk"
                                            value="{{ auth()->user()->nik ?? auth()->user()->nomor_induk }}">
                                    </div>
                                    <div class="text-end">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="small text-danger text-decoration-none fw-bold">Bukan Anda? Ganti
                                            Akun</a>
                                    </div>
                                @else
                                    <div
                                        class="alert bg-pale-custom border-0 small p-3 rounded-3 mb-4 d-flex align-items-center">
                                        <i class="bi bi-info-circle-fill text-success fs-4 me-3"></i>
                                        <div>Punya akun? <a href="{{ route('login') }}"
                                                class="fw-bold text-success text-decoration-none">Login di sini</a> untuk
                                            autofill data.</div>
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" class="form-control input-modern" id="donor_name"
                                            name="donor_name" required placeholder="Nama Lengkap Anda">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control input-modern" id="donor_email"
                                            name="donor_email" required placeholder="Alamat Email (Contoh@mail.com)">
                                    </div>
                                    <div class="mb-3">
                                        <select name="donor_category" id="donor_category"
                                            class="form-select input-modern" required>
                                            <option value="" disabled selected>-- Kategori Wakif --</option>
                                            <option value="umum">Umum</option>
                                            <option value="mahasiswa">Mahasiswa</option>
                                            <option value="alumni">Alumni</option>
                                            <option value="dosen">Dosen</option>
                                            <option value="tenaga_pendidik">Tenaga Pendidik</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control input-modern" id="donor_phone"
                                            name="donor_phone" required placeholder="No. HP / WhatsApp" maxlength="14">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control input-modern" id="donor_nomor_induk"
                                            name="donor_nomor_induk" required placeholder="NIM / NIP / NIK"
                                            maxlength="20">
                                    </div>
                                @endauth
                            </div>

                            <button type="submit"
                                class="btn w-100 btn-donate-huge d-flex justify-content-between align-items-center">
                                <span>Lanjutkan Pembayaran</span>
                                <i class="bi bi-arrow-right-circle-fill fs-4"></i>
                            </button>

                            <div class="text-center mt-4 pt-3 border-top">
                                <p class="text-muted small fw-bold mb-2">Akses Cepat:</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('donations.check') }}"
                                        class="btn btn-sm btn-light border rounded-pill px-3 fw-bold text-secondary">Cek
                                        Status</a>
                                    <a href="{{ route('public.wakaf.history') }}"
                                        class="btn btn-sm btn-light border rounded-pill px-3 fw-bold text-secondary">Riwayat
                                        Saya</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // JAVASCRIPT LOGIC TETAP SAMA, HANYA GANTI CLASS CSS BUTTON
            document.addEventListener("DOMContentLoaded", function() {
                // Konfigurasi Chart.js (Sama persis)
                const ctx = document.getElementById('wakafChart').getContext('2d');
                const labels = @json($labels);
                const dataValues = @json($totals);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Aset Terkumpul',
                            data: dataValues,
                            backgroundColor: [
                                'rgba(200, 200, 200, 0.4)',
                                'rgba(132, 177, 121, 0.9)',
                                'rgba(132, 177, 121, 0.4)'
                            ],
                            borderColor: '#84B179',
                            borderWidth: 1,
                            borderRadius: 8,
                            barPercentage: 0.6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ' Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    borderDash: [5, 5],
                                    color: '#e3e8e3'
                                },
                                ticks: {
                                    callback: function(value) {
                                        if (value >= 1000000000) return (value / 1000000000) + ' M';
                                        if (value >= 1000000) return (value / 1000000) + ' Jt';
                                        return value;
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

                // Logic Tombol Nominal
                const customInput = document.getElementById('customAmount');
                const hiddenInput = document.getElementById('amount_hidden');
                const btns = document.querySelectorAll('.btn-nominal-modern');
                const warningMsg = document.getElementById('minAmountWarning');

                btns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        // Hapus active dari semua tombol
                        btns.forEach(b => b.classList.remove('active'));
                        // Tambah active ke yang di klik
                        this.classList.add('active');

                        const val = this.getAttribute('data-value');
                        customInput.value = ""; // Kosongkan input manual
                        hiddenInput.value = val;
                        warningMsg.classList.add('d-none');
                    });
                });

                customInput.addEventListener('input', function() {
                    btns.forEach(b => b.classList.remove('active'));
                    hiddenInput.value = this.value;

                    if (this.value > 0 && this.value < 10000) {
                        warningMsg.classList.remove('d-none');
                    } else {
                        warningMsg.classList.add('d-none');
                    }
                });

                // Validasi Form Submit
                const form = document.querySelector('form');
                form.addEventListener('submit', function(e) {
                    let val = parseInt(hiddenInput.value);
                    if (!val || val < 10000) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Nominal Tidak Valid',
                            text: 'Mohon maaf, minimal wakaf tunai mulai dari Rp 10.000',
                            confirmButtonColor: '#84B179',
                            confirmButtonText: 'Baik, Saya Mengerti'
                        });
                        customInput.focus();
                    }
                });
            });
        </script>
    @endpush
</x-layouts.app>
