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
                                {{-- DATA DONATUR BARU YANG DINAMIS --}}
                                <strong class="text-success d-block">{{ $donor_count }}</strong>
                                <small class="text-muted">Donatur</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <a href="#donationSection" class="btn btn-success btn-lg"><i class="bi bi-heart me-2"></i>Donasi
                            Sekarang</a>
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
                        <p class="lead" style="white-space: pre-wrap;">{{ $program->description }}</p>
                    </article>
                </div>

                <div class="col-lg-4">
                    <div class="donation-sidebar" id="donationSection">
                        <h4 class="text-center mb-4">Dukung Program Ini</h4>
                        <form action="{{ route('donations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="program_id" value="{{ $program->id }}">
                            <input type="hidden" name="amount" id="amount_hidden">

                            <div class="mb-3"><label class="form-label fw-bold">Pilih Nominal Cepat</label>
                                <div class="donation-option" data-amount="50000"><span>Rp 50.000</span><small
                                        class="text-muted d-block">Membantu 1 buku referensi</small></div>
                                <div class="donation-option" data-amount="100000"><span>Rp 100.000</span><small
                                        class="text-muted d-block">Bantuan transportasi 1 bulan</small></div>
                            </div>
                            <div class="mb-4"><label for="customAmount" class="form-label fw-bold">Atau Masukkan
                                    Nominal Lain</label>
                                <div class="input-group"><span class="input-group-text">Rp</span><input type="number"
                                        class="form-control" id="customAmount" placeholder="15000000"></div>
                            </div>
                            <div class="mb-3">
                                <label for="donor_name" class="form-label">Nama Anda</label>
                                <input type="text" class="form-control" id="donor_name" name="donor_name" required
                                    value="{{ auth()->user()->nama ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="donor_email" class="form-label">Email Anda</label>
                                <input type="email" class="form-control" id="donor_email" name="donor_email" required
                                    value="{{ auth()->user()->email ?? '' }}">
                            </div>
                            <button type="submit" class="btn btn-success w-100 btn-lg"><i
                                    class="bi bi-credit-card me-2"></i>Lanjutkan Donasi</button>
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
        </script>
    @endpush
</x-layouts.app>
