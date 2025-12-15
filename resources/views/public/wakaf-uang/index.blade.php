<x-layouts.app>
    <x-slot:title>Wakaf Uang Abadi</x-slot:title>

    @push('styles')
        <style>
            /* 1. MENGGUNAKAN CSS YANG SAMA PERSIS DENGAN DETAIL PROGRAM */
            .wakaf-hero {
                /* Copy-Paste dari style .program-detail-hero referensimu */
                background: linear-gradient(135deg, rgba(25, 135, 84, 0.9) 0%, rgba(32, 201, 151, 0.9) 100%), 
                            url("{{ $program->image ? asset('storage/programs/' . $program->image) : 'https://via.placeholder.com/1920x800/198754/ffffff?text=Wakaf+Uang+UNAND' }}") center/cover;
                color: white;
                padding: 100px 0;
                /* Tambahan: Biar posisi relatif buat hiasan background */
                position: relative; 
                overflow: hidden;
            }
            
            /* Style Kartu Saldo (Ini tambahan khusus halaman ini) */
            .saldo-card {
                background: rgba(255, 255, 255, 0.95);
                border-radius: 20px;
                backdrop-filter: blur(10px);
                transition: transform 0.3s ease;
                color: #212529; /* Text dark */
            }
            .saldo-card:hover {
                transform: translateY(-5px);
            }
        </style>
    @endpush

    {{-- 2. SECTION HERO --}}
    {{-- Tambahkan style="padding-top: 150px;" supaya konsisten tingginya dengan halaman lain --}}
    <section class="wakaf-hero" style="padding-top: 88px;">
        
        {{-- Hiasan Background (Dompet Transparan) --}}
        <div class="position-absolute top-10 end-10 opacity-10" style="transform: translate(20%, -20%) rotate(-15deg);">
            <i class="bi bi-wallet2" style="font-size: 18rem; color: rgba(255,255,255,0.3);"></i>
        </div>

        <div class="container position-relative z-index-1 text-center">
            <span class="badge bg-warning text-dark mb-2 px-4 py-2 rounded-pill fw-bold shadow-sm">
                <i class="bi bi-infinity me-1"></i> DANA ABADI UMAT
            </span>
            <h1 class="display-4 fw-bold mb-2">Wakaf Uang</h1>
            <p class="lead mb-2 text-white-50 mx-auto">
                Wujudkan kebaikan yang pokoknya terjaga, dan pahalanya terus mengalir selamanya
            </p>

            {{-- KOTAK TOTAL SALDO --}}
            <div class="saldo-card border-0 shadow-lg d-inline-block p-1">
                <small class="text-uppercase text-muted fw-bold ls-1">Total Dana Terkelola</small>
                <h2 class="display-3 fw-bold text-success mt-1 mb-0" style="font-family: monospace;">
                    Rp{{ number_format($totalFunds, 0, ',', '.') }}
                </h2>
                <div class="mt-2 badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                    <i class="bi bi-graph-up-arrow me-1"></i> Update Realtime
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top: -80px;">
        <div class="row justify-content-center">
            
            {{-- 3. SECTION GRAFIK (CHART) --}}
            <div class="col-lg-10 mb-4">
                <div class="card border-0 shadow rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-2 border-0 text-center border-bottom">
                        <h5 class="fw-bold m-0 text-success">
                            <i class="bi bi-bar-chart-line-fill me-2"></i>Pertumbuhan Aset Wakaf
                        </h5>
                    </div>
                    <div class="card-body p-1">
                        <div style="height: 350px; position: relative;">
                            <canvas id="wakafChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                
                {{-- 4. DESKRIPSI PROGRAM --}}
                <article class="blog-post mb-4 text-muted" style="font-size: 1.1rem; line-height: 1.8;">
                    <h3 class="text-dark fw-bold mb-2 text-center">Tentang Program Ini</h3>
                    {!! nl2br(e($program->description)) !!}
                </article>

                {{-- TOMBOL CALL TO ACTION (CTA) --}}
                <div class="text-center mb-4">
                    <button type="button" 
                            onclick="scrollToForm()"
                            class="btn btn-success btn-lg px-4 py-3 rounded-pill fw-bold shadow hover-lift">
                        <i class="bi bi-gift-fill me-2"></i> TUNAIKAN WAKAF SEKARANG
                    </button>
                    <p class="small text-muted mt-2">
                        <i class="bi bi-shield-check me-1"></i> Dikelola Profesional oleh UPW UNAND
                    </p>
                </div>
            </div>

            {{-- 5. FORM DONASI --}}
            <div id="form-wakaf-area" class="col-lg-7 mb-4" style="scroll-margin-top: 100px;">
                <div class="card border-success shadow-sm">
                    <div class="card-header bg-success text-white text-center py-3">
                        <h5 class="m-0 fw-bold">Formulir Wakaf Tunai</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <form action="{{ route('donations.store') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="program_id" value="{{ $program->id }}">
                            <input type="hidden" name="amount" id="amount_hidden">

                            {{-- Pilihan Nominal Cepat --}}
                            <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Nominal Wakaf</label>
                    <div class="row g-2">
                        {{-- Tombol 100rb --}}
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-success w-100 nominal-btn px-0" data-value="100000">100rb</button>
                        </div>
                        
                        {{-- Tombol 250rb (Baru) --}}
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-success w-100 nominal-btn px-0" data-value="250000">250rb</button>
                        </div>

                        {{-- Tombol 500rb --}}
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-success w-100 nominal-btn px-0" data-value="500000">500rb</button>
                        </div>

                        {{-- Tombol 1 Juta --}}
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-success w-100 nominal-btn px-0" data-value="1000000">1 Jt</button>
                        </div>
                    </div>
                </div>

                            {{-- Input Nominal Manual --}}
                            <div class="mb-2">
                                <label class="form-label fw-bold">Atau Masukkan Nominal Lain</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-bold">Rp</span>
                                    <input type="number" class="form-control form-control-lg fw-bold text-success" 
                                           id="customAmount" placeholder="0" min="5000">
                                </div>
                                <small class="text-muted">Minimal wakaf Rp 10.000</small>
                            </div>

                            {{-- Data Diri --}}
                            <div class="mb-2">
                                <label class="form-label">Nama Wakif (Pewakaf)</label>
                                <input type="text" name="donor_name" class="form-control" 
                                       value="{{ auth()->user()->nama ?? '' }}" required placeholder="Nama Lengkap">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email (Untuk Bukti & Sertifikat)</label>
                                <input type="email" name="donor_email" class="form-control" 
                                       value="{{ auth()->user()->email ?? '' }}" required placeholder="email@contoh.com">
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-3 fw-bold fs-5">
                                <i class="bi bi-heart-fill me-2"></i>Lanjutkan Pembayaran Wakaf<i class="bi bi-arrow-right ms-2"></i>
                            </button>

                            <div class="text-center pt-2 border-top">
                                <small class="text-muted d-block mb-2">Sudah pernah berwakaf?</small>
                                <a href="{{ route('donations.check') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                                    <i class="bi bi-search me-1"></i> Cek Status Wakaf
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- 6. WAKIF TERBARU --}}
            @if($latestDonors->count() > 0)
                <div class="m-2">
                    <h5 class="fw-bold text-dark mb-4">
                        <i class="bi bi-people-fill text-success me-2"></i>Wakif Terbaru
                    </h5>

                    <div class="list-group list-group-flush border rounded-4 shadow-sm overflow-hidden">
                        @foreach($latestDonors as $donor)
                            <div class="list-group-item p-3 border-light">
                                <div class="d-flex align-items-center">
                                    
                                    {{-- Avatar Inisial (Bulat) --}}
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center fw-bold" 
                                            style="width: 45px; height: 45px; font-size: 1.2rem;">
                                            {{ substr($donor->donor_name, 0, 1) }}
                                        </div>
                                    </div>

                                    {{-- Info Donatur --}}
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-bold text-dark">
                                                {{-- Sensor Nama Belakang (Opsional, biar privasi terjaga dikit) --}}
                                                {{ Str::mask($donor->donor_name, '*', 4) }}
                                            </h6>
                                            <small class="text-muted" style="font-size: 0.8rem;">
                                                {{ $donor->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <small class="text-muted d-block">
                                            Berwakaf <span class="text-success fw-bold">Rp{{ number_format($donor->amount, 0, ',', '.') }}</span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function scrollToForm() {
            document.getElementById('form-wakaf-area').scrollIntoView({ behavior: 'smooth' });
            document.getElementById('customAmount').focus();
        }

        
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('wakafChart').getContext('2d');
            
            // UPDATE DI SINI:
            // Kita pakai variabel baru dari controller ($labels dan $totals)
            const labels = @json($labels);    // Isinya: ["Tahun 2024", "Tahun 2025", "Tahun 2026"]
            const dataValues = @json($totals); // Isinya: [0, 15000000, 30000000...]

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Aset Terkumpul',
                        data: dataValues,
                        backgroundColor: [
                            'rgba(200, 200, 200, 0.5)', // 2024 (Abu-abu karena kosong/masa lalu)
                            'rgba(25, 135, 84, 0.8)',   // 2025 (Hijau - Current)
                            'rgba(25, 135, 84, 0.4)'    // 2026 (Hijau Muda - Future)
                        ],
                        borderColor: '#198754',
                        borderWidth: 1,
                        borderRadius: 8,
                        barPercentage: 0.6
                    }]
                },
                // ... options sisanya sama persis ...
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
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
                            grid: { borderDash: [5, 5] },
                            ticks: {
                                callback: function(value) {
                                    if(value >= 1000000000) return (value/1000000000) + ' M'; // Format Miliar
                                    if(value >= 1000000) return (value/1000000) + ' Jt';
                                    return value;
                                }
                            }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        });

        const customInput = document.getElementById('customAmount');
        const hiddenInput = document.getElementById('amount_hidden');
        const btns = document.querySelectorAll('.nominal-btn');

        btns.forEach(btn => {
            btn.addEventListener('click', function() {
                btns.forEach(b => {
                    b.classList.remove('btn-success', 'text-white');
                    b.classList.add('btn-outline-success');
                });
                this.classList.remove('btn-outline-success');
                this.classList.add('btn-success', 'text-white');
                const val = this.getAttribute('data-value');
                customInput.value = ""; 
                hiddenInput.value = val; 
            });
        });

        customInput.addEventListener('input', function() {
            btns.forEach(b => {
                b.classList.remove('btn-success', 'text-white');
                b.classList.add('btn-outline-success');
            });
            hiddenInput.value = this.value;
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            let val = parseInt(hiddenInput.value);
            if (!val || val < 10000) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Nominal Kurang',
                    text: 'Mohon maaf, minimal wakaf tunai mulai dari Rp 10.000',
                    confirmButtonColor: '#198754'
                });
            }
        });
    </script>
    @endpush
</x-layouts.app>