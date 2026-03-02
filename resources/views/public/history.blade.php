<x-layouts.app>
    <x-slot:title>Lacak Portofolio Wakaf - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            :root {
                --c-main: #84B179;
                --c-hover: #A2CB8B;
                --c-light: #C7EABB;
                --c-pale: #E8F5BD;
                --c-dark: #1a2e15;
            }

            body {
                background-color: #f8faf7;
            }

            /* HERO SECTION */
            .history-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.85) 100%),
                    url("https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=1920") center/cover no-repeat;
                color: white;
                padding: 160px 0 100px 0;
                position: relative;
            }

            .hero-pattern {
                position: absolute;
                inset: 0;
                opacity: 0.1;
                background-image: radial-gradient(#fff 1px, transparent 1px);
                background-size: 20px 20px;
            }

            /* SEARCH BAR FLOATING */
            .search-floating-card {
                background: white;
                border-radius: 24px;
                padding: 2rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
                position: relative;
                z-index: 10;
                margin-top: -60px;
            }

            .input-modern-group {
                background: #f8faf7;
                border-radius: 50px;
                padding: 5px;
                display: flex;
                align-items: center;
                border: 2px solid transparent;
                transition: all 0.3s;
            }

            .input-modern-group:focus-within {
                border-color: var(--c-main);
                background: white;
                box-shadow: 0 5px 15px rgba(132, 177, 121, 0.1);
            }

            .input-modern {
                border: none;
                background: transparent;
                box-shadow: none !important;
                font-size: 1.1rem;
                padding: 10px 20px;
            }

            .btn-search-modern {
                background: var(--c-main);
                color: white;
                border: none;
                padding: 12px 30px;
                border-radius: 50px;
                font-weight: 700;
                transition: all 0.3s;
            }

            .btn-search-modern:hover {
                background: var(--c-dark);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(26, 46, 21, 0.2);
            }

            /* RESULT CARD & TABLE */
            .result-card-modern {
                background: white;
                border-radius: 24px;
                overflow: hidden;
                border: none;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            }

            .table-modern {
                margin-bottom: 0;
            }

            .table-modern thead {
                background: var(--c-pale);
                color: var(--c-dark);
            }

            .table-modern th {
                font-weight: 700;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
                padding: 1rem 1.5rem;
                border-bottom: none;
            }

            .table-modern td {
                padding: 1.2rem 1.5rem;
                vertical-align: middle;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                transition: background 0.2s;
            }

            .table-modern tbody tr:hover td {
                background-color: #fcfdfc;
            }

            .table-modern tbody tr:last-child td {
                border-bottom: none;
            }

            /* ALERT SUMMARY */
            .summary-alert {
                background: linear-gradient(to right, rgba(132, 177, 121, 0.1), rgba(162, 203, 139, 0.05));
                border: 1px dashed var(--c-main);
                border-radius: 16px;
                color: var(--c-dark);
                padding: 1.5rem;
            }
        </style>
    @endpush

    <section class="history-hero">
        <div class="hero-pattern"></div>
        <div class="container position-relative z-index-1 text-center">
            <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm" data-aos="fade-down">
                <i class="bi bi-clock-history me-2"></i> REKAM JEJAK
            </span>
            <h1 class="display-4 fw-bolder mb-3" data-aos="fade-up">Lacak Kebaikan Anda</h1>
            <p class="fs-5 text-white-50 mx-auto" style="max-width: 600px; line-height: 1.6;" data-aos="fade-up"
                data-aos-delay="100">
                Transparansi adalah komitmen kami. Lacak status dan riwayat portofolio wakaf Anda kapan saja.
            </p>
        </div>
    </section>

    <section class="py-0 position-relative z-3">
        <div class="container">

            {{-- SEARCH FORM --}}
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="search-floating-card" data-aos="zoom-in" data-aos-delay="200">
                        <label class="form-label fw-bold text-muted mb-3 d-block text-center">Pencarian Riwayat
                            Wakaf</label>
                        <form action="{{ route('public.wakaf.history') }}" method="GET">
                            <div class="input-modern-group">
                                <span class="ps-3 pe-2 text-muted"><i class="bi bi-search"></i></span>
                                <input type="text" name="keyword" class="form-control input-modern flex-grow-1"
                                    placeholder="Ketik Email, No. WA, atau NIM/NIP..."
                                    value="{{ request('keyword') ?? '' }}" required>
                                <button class="btn-search-modern" type="submit">Cari Riwayat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- RESULT AREA --}}
            @if (request('keyword'))
                <div class="row justify-content-center mt-5 mb-5 pb-5">
                    <div class="col-lg-10" data-aos="fade-up">

                        @if ($donations->count() > 0)
                            {{-- SUMMARY ALERT --}}
                            <div
                                class="summary-alert d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                                <div class="mb-3 mb-md-0">
                                    <h5 class="fw-bolder mb-1"><i class="bi bi-check-circle-fill text-success me-2"></i>
                                        Data Ditemukan</h5>
                                    <p class="text-muted mb-0 small">Menampilkan
                                        <strong>{{ $donations->count() }}</strong> riwayat transaksi untuk pencarian
                                        "<span class="fw-bold">{{ request('keyword') }}</span>".</p>
                                </div>
                                <div
                                    class="text-md-end bg-white px-4 py-2 rounded-pill shadow-sm border border-success-subtle">
                                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Total
                                        Portofolio</small>
                                    <h4 class="fw-bolder text-success mb-0">Rp
                                        {{ number_format($donations->sum('amount'), 0, ',', '.') }}</h4>
                                </div>
                            </div>

                            {{-- DATA TABLE --}}
                            <div class="result-card-modern">
                                <div class="table-responsive">
                                    <table class="table table-modern align-middle">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Program Wakaf</th>
                                                <th>No. Order</th>
                                                <th>Nominal</th>
                                                <th>Sertifikat / Akte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($donations as $d)
                                                <tr>
                                                    <td>
                                                        <span
                                                            class="d-block fw-bold text-dark">{{ $d->created_at?->format('d M Y') }}</span>
                                                        <small class="text-muted">{{ $d->created_at?->format('H:i') }}
                                                            WIB</small>
                                                    </td>
                                                    <td>
                                                        <span class="fw-bold" style="color: var(--c-dark);">
                                                            {{ $d->program->title ?? 'Wakaf Uang Tunai (Abadi)' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-light text-secondary border px-2 py-1"
                                                            style="font-family: monospace;">{{ $d->order_id }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="fw-bolder text-success">Rp
                                                            {{ number_format($d->amount, 0, ',', '.') }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($d->nomor_akte)
                                                            <div class="d-flex align-items-center gap-2">
                                                                <span
                                                                    class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                                                    <i class="bi bi-patch-check-fill me-1"></i>
                                                                    {{ $d->nomor_akte }}
                                                                </span>
                                                            </div>
                                                        @else
                                                            <span class="badge bg-light text-muted fw-normal"><i
                                                                    class="bi bi-hourglass-split me-1"></i> Dalam
                                                                Proses</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            {{-- NOT FOUND STATE --}}
                            <div class="text-center py-5 mt-4">
                                <div class="d-inline-block p-4 rounded-circle mb-3"
                                    style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
                                    <i class="bi bi-search-mismatch" style="font-size: 3rem;"></i>
                                </div>
                                <h3 class="fw-bolder" style="color: var(--c-dark);">Data Tidak Ditemukan</h3>
                                <p class="text-muted fs-5 mx-auto" style="max-width: 500px;">
                                    Tidak ada riwayat wakaf yang cocok dengan
                                    <strong>"{{ request('keyword') }}"</strong>. <br>
                                    Pastikan Email, No. WA, atau NIM yang dimasukkan sama persis dengan saat Anda
                                    mengisi form donasi.
                                </p>
                            </div>
                        @endif

                    </div>
                </div>
            @endif
        </div>
    </section>

</x-layouts.app>
