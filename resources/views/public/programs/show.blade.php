<x-layouts.app>
    <x-slot:title>Detail Program: {{ $program->title }}</x-slot:title>

    @push('styles')
        {{-- (Salin CSS dari implementasi sebelumnya jika diperlukan) --}}
        <style>
            .program-detail-hero {
                background: linear-gradient(135deg, rgba(25, 135, 84, 0.9) 0%, rgba(32, 201, 151, 0.9) 100%), url("{{ asset('storage/programs/' . $program->image) }}") center/cover;
                color: white;
                padding: 100px 0;
            }

            .program-stats-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                margin-top: -50px;
                position: relative;
                z-index: 10;
            }

            .program-content {
                font-size: 1.1rem;
                line-height: 1.8;
            }

            .donation-sidebar {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                position: sticky;
                top: 100px;
            }

            .donation-option {
                border: 2px solid #e9ecef;
                border-radius: 0.5rem;
                padding: 1rem;
                margin-bottom: 1rem;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .donation-option:hover,
            .donation-option.selected {
                border-color: #198754;
                background: rgba(25, 135, 84, 0.05);
            }

            .donation-sidebar {
                position: sticky;
                top: 100px; /* Jarak dari atas */
                background: white;
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.05);
                border: 1px solid #e9ecef;
            }

            /* Style Tombol Nominal */
            .donation-option {
                cursor: pointer;
                border: 2px solid #dee2e6;
                border-radius: 10px;
                padding: 10px 15px;
                margin-bottom: 10px;
                transition: all 0.2s;
            }

            .donation-option:hover {
                border-color: #198754;
                background-color: #f8fffb;
            }

            /* Kalau dipilih */
            .donation-option.selected {
                border-color: #198754;
                background-color: #e9f7ef;
                color: #198754;
                font-weight: bold;
            }
        </style>
    @endpush

    <section class="program-detail-hero" style="padding-top: 150px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-4">{{ $program->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="program-stats-section py-0">
        <div class="container">
            <div class="program-stats-card">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="program-progress mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Terkumpul</span>
                                <span class="text-success fw-bold">Rp
                                    {{ number_format($program->collected_amount, 0, ',', '.') }} / Rp
                                    {{ number_format($program->target_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="progress progress-lg">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $program->progres_persentase }}%"></div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-4">
                                <strong class="text-success d-block">{{ $program->progres_persentase }}%</strong>
                                <small class="text-muted">Progress</small>
                            </div>
                            <div class="col-4">
                                {{-- LOGIKA BARU UNTUK HARI TERSISA --}}
                                @if ($program->days_remaining !== null)
                                    <strong class="text-success d-block">{{ $program->days_remaining }} Hari</strong>
                                @else
                                    <strong class="text-success d-block">-</strong>
                                @endif
                                <small class="text-muted">Tersisa</small>
                            </div>
                            <div class="col-4">
                                {{-- DATA WAKIF BARU YANG DINAMIS --}}
                                <strong class="text-success d-block">{{ $donor_count }}</strong>
                                <small class="text-muted">Wakaf Masuk</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <a href="#donationSection" class="btn btn-success btn-lg">
                            <i class="bi bi-gift-fill me-2"></i>Wakaf Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="program-content-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <article class="program-content">
                        {{-- TAMBAHAN: FOTO PROGRAM --}}
                        @if ($program->image)
                            <div class="mb-4 text-center">
                                <img src="{{ asset('storage/programs/' . $program->image) }}" 
                                    alt="{{ $program->title }}" 
                                    class="img-fluid rounded-2 shadow-sm w-100" 
                                    style="max-height: 400px; object-fit: cover;">
                            </div>
                        @endif

                        {{-- Deskripsi Program (Yang Lama) --}}
                        <p class="lead" style="white-space: pre-wrap;">{{ $program->description }}</p>
                    </article>
                    {{-- SECTION: DONATUR TERBARU --}}
                    @if($latestDonors->count() > 0)
                        <div class="mt-5">
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

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="donation-sidebar" id="donationSection">
                        <h4 class="text-center fw-bold mb-2 text-success">Dukung Program Ini</h4>
                        
                        <form action="{{ route('donations.store') }}" method="POST" id="form-donasi" novalidate>
                            @csrf
                            <input type="hidden" name="program_id" value="{{ $program->id }}">
                            {{-- Input Rahasia buat nyimpen angka asli --}}
                            <input type="hidden" name="amount" id="amount_hidden">

                            {{-- Opsi Nominal Cepat --}}
                            <div class="mb-2">
                                <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-success-subtle text-success me-2">
                                    <i class="bi bi-cash-coin"></i> {{-- Icon Uang --}}
                                </span>
                                <span class="small text-uppercase text-muted fw-bold">Pilih Nominal Cepat</span>
                            </div>
                                
                                <div class="row g-2"> {{-- g-2 artinya gap/jarak antar kotak kecil --}}
                                    
                                    {{-- Kotak 1: 100rb --}}
                                    <div class="col-6">
                                        <div class="donation-option text-center py-2" data-amount="100000">
                                            <span class="fw-bold d-block">Rp100.000</span>
                                        </div>
                                    </div>

                                    {{-- Kotak 2: 250rb --}}
                                    <div class="col-6">
                                        <div class="donation-option text-center py-2" data-amount="250000">
                                            <span class="fw-bold d-block">Rp250.000</span>
                                        </div>
                                    </div>

                                    {{-- Kotak 3: 500rb --}}
                                    <div class="col-6">
                                        <div class="donation-option text-center py-2" data-amount="500000">
                                            <span class="fw-bold d-block">Rp500.000</span>
                                        </div>
                                    </div>

                                    {{-- Kotak 4: 1 Juta --}}
                                    <div class="col-6">
                                        <div class="donation-option text-center py-2" data-amount="1000000">
                                            <span class="fw-bold d-block">Rp1.000.000</span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Input Manual --}}
                            <div class="mb-2">
                                <label for="customAmount" class="form-label fw-bold small text-uppercase text-muted">Nominal Lainnya</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white fw-bold text-success">Rp</span>
                                    <input type="number" class="form-control fw-bold text-success" 
                                        id="customAmount" placeholder="0" min="10000">
                                </div>
                                <small class="text-muted">Minimal donasi Rp10.000</small>
                            </div>

                           {{-- Data Diri Section --}}
                            <div class="mb-2">
                                {{-- Judul Seksi Kecil --}}
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge bg-success-subtle text-success me-2">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <span class="small text-uppercase text-muted fw-bold">Data Wakif</span>
                                </div>

                                {{-- Input Nama --}}
                                <div class="mb-2">
                                    <label for="donor_name" class="form-label fw-bold small">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="donor_name" name="donor_name" required
                                        value="{{ auth()->user()->nama ?? '' }}" placeholder="Masukkan nama Anda">
                                </div>
                                
                                {{-- Input Email --}}
                                <div class="mb-2">
                                    <label for="donor_email" class="form-label fw-bold small">Alamat Email</label>
                                    <input type="email" class="form-control" id="donor_email" name="donor_email" required
                                        value="{{ auth()->user()->email ?? '' }}" placeholder="contoh@email.com">
                                    <div class="form-text" style="font-size: 0.75rem;">
                                        Bukti pembayaran akan dikirim ke email ini
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100 btn-lg fw-bold shadow-sm" id="btn-submit">
                                <i class="bi bi-heart-fill me-2"></i>Lanjutkan Wakaf <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                            <div class="text-center pt-2 border-top">
                                <small class="text-muted d-block mb-2">Sudah pernah berwakaf?</small>
                                <a href="{{ route('donations.check') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                                    <i class="bi bi-search me-1"></i> Cek Status Wakaf
                                </a>
                            </div>
                            <div class="text-center mt-2">
                                <small class="text-muted"><i class="bi bi-shield-lock"></i> Dikelola Profesional oleh UPW UNAND</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="related-programs-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h3 class="section-title">Program Lainnya</h3>
                    <p class="section-subtitle">Jelajahi program-program kebaikan lainnya dari Dana Sosial UNAND</p>
                </div>
            </div>
            <div class="row g-4">
                @forelse ($related_programs as $related)
                    <div class="col-lg-4 col-md-6">
                        {{-- Kita gunakan lagi kode kartu program yang sudah kita sempurnakan --}}
                        <div class="program-card h-100" data-aos="fade-up">
                            <div class="program-image">
                                <a href="{{ route('programs.show.public', $related->id) }}">
                                    <img src="{{ asset('storage/programs/' . $related->image) }}"
                                        alt="{{ $related->title }}" class="card-img-top">
                                </a>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="program-title">
                                    <a href="{{ route('programs.show.public', $related->id) }}"
                                        class="text-decoration-none text-dark">{{ $related->title }}</a>
                                </h5>
                                <p class="program-description">{{ Str::limit($related->description, 90) }}</p>
                                <div class="mt-auto">
                                    <div class="program-progress mb-3">
                                        <div class="d-flex justify-content-between mb-1"><small
                                                class="text-muted">Terkumpul</small><small
                                                class="text-muted">{{ $related->progres_persentase }}%</small></div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $related->progres_persentase }}%"></div>
                                        </div>
                                    </div>
                                    <div class="program-stats mb-3">
                                        <div class="row text-center">
                                            <div class="col-6"><strong class="text-success">Rp
                                                    {{ $related->formatted_collected_amount }}</strong>
                                                <div class="small text-muted">Terkumpul</div>
                                            </div>
                                            <div class="col-6"><strong class="text-success">Rp
                                                    {{ $related->formatted_target_amount }}</strong>
                                                <div class="small text-muted">Target</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('programs.show.public', $related->id) }}"
                                        class="btn btn-success w-100">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Tidak ada program lainnya saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const options = document.querySelectorAll('.donation-option');
                const customAmountInput = document.getElementById('customAmount');
                const hiddenAmountInput = document.getElementById('amount_hidden');

                function updateSelection(selectedOption) {
                    options.forEach(opt => opt.classList.remove('selected'));
                    if (selectedOption) {
                        selectedOption.classList.add('selected');
                        const amount = selectedOption.getAttribute('data-amount');
                        customAmountInput.value = '';
                        hiddenAmountInput.value = amount;
                    }
                }

                options.forEach(option => {
                    option.addEventListener('click', function() {
                        updateSelection(this);
                    });
                });

                customAmountInput.addEventListener('input', function() {
                    if (this.value) {
                        updateSelection(null); // Hapus seleksi dari opsi cepat
                        hiddenAmountInput.value = this.value;
                    }
                });
            });
            const donationForm = document.querySelector('form[action="{{ route('donations.store') }}"]');

            donationForm.addEventListener('submit', function(e) {
                // 1. Ambil nilai dari input rahasia (amount_hidden)
                let nominal = document.getElementById('amount_hidden').value;
                
                // 2. Konversi jadi angka (biar aman)
                nominal = parseInt(nominal);

                if (!nominal || isNaN(nominal)) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Nominal Belum Diisi',
                        text: 'Silakan pilih atau masukkan nominal donasi terlebih dahulu.',
                        confirmButtonColor: '#ffc107' // Warna kuning warning
                    });
                    return; // Stop, jangan lanjut ke cek bawahnya
                }

                // 3. Cek Logic: Kalau kosong ATAU di bawah 10000
                if (nominal < 10000) {
                    e.preventDefault(); // STOP! Jangan kirim ke server
                    
                    // Munculin SweetAlert Warning
                    Swal.fire({
                        icon: 'warning',
                        title: 'Nominal Kurang',
                        text: 'Maaf Bapak/Ibu, minimal donasi mulai dari Rp10.000',
                        confirmButtonColor: '#198754'
                    });
                }
            });
        </script>
    @endpush
</x-layouts.app>
