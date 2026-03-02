<x-layouts.app>
    <x-slot:title>Cek Status Wakaf - Dana Sosial UNAND</x-slot:title>

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
            .check-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.85) 100%),
                    url("https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&q=80&w=1920") center/cover no-repeat;
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

            /* SEARCH BOX MODERN */
            .search-box-modern {
                background: white;
                border-radius: 24px;
                padding: 3rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
                position: relative;
                z-index: 10;
                margin-top: -60px;
            }

            .input-modern-group {
                background: #f8faf7;
                border-radius: 16px;
                padding: 8px;
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
                font-weight: 700;
                color: var(--c-dark);
                letter-spacing: 1px;
            }

            .input-modern::placeholder {
                font-weight: 400;
                letter-spacing: normal;
                opacity: 0.5;
            }

            .btn-search-modern {
                background: var(--c-main);
                color: white;
                border: none;
                padding: 12px 30px;
                border-radius: 12px;
                font-weight: 700;
                transition: all 0.3s;
            }

            .btn-search-modern:hover {
                background: var(--c-dark);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(26, 46, 21, 0.2);
            }

            /* RECEIPT/TICKET CARD */
            .receipt-card {
                background: white;
                border-radius: 24px;
                overflow: hidden;
                border: none;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
                position: relative;
            }

            .receipt-header {
                background: var(--c-pale);
                padding: 2rem;
                text-align: center;
                border-bottom: 2px dashed rgba(132, 177, 121, 0.3);
                position: relative;
            }

            /* Efek sobekan struk */
            .receipt-header::before,
            .receipt-header::after {
                content: '';
                position: absolute;
                bottom: -12px;
                width: 24px;
                height: 24px;
                background: #f8faf7;
                border-radius: 50%;
            }

            .receipt-header::before {
                left: -12px;
                box-shadow: inset -3px 0 5px rgba(0, 0, 0, 0.02);
            }

            .receipt-header::after {
                right: -12px;
                box-shadow: inset 3px 0 5px rgba(0, 0, 0, 0.02);
            }

            .receipt-body {
                padding: 2.5rem;
            }

            .list-group-custom .list-group-item {
                border: none;
                border-bottom: 1px solid rgba(0, 0, 0, 0.03);
                padding: 1rem 0;
                background: transparent;
            }

            .list-group-custom .list-group-item:last-child {
                border-bottom: none;
            }

            /* STATUS BADGES */
            .status-badge-lg {
                font-size: 1.1rem;
                padding: 10px 30px;
                border-radius: 50px;
                font-weight: 800;
                display: inline-flex;
                align-items: center;
                letter-spacing: 1px;
            }

            .status-success {
                background: rgba(25, 135, 84, 0.1);
                color: #198754;
                border: 1px solid rgba(25, 135, 84, 0.2);
            }

            .status-pending {
                background: rgba(255, 193, 7, 0.1);
                color: #b28600;
                border: 1px solid rgba(255, 193, 7, 0.2);
            }

            .status-failed {
                background: rgba(220, 53, 69, 0.1);
                color: #dc3545;
                border: 1px solid rgba(220, 53, 69, 0.2);
            }

            /* ALERT MODERN */
            .alert-modern {
                border-radius: 16px;
                border: none;
                padding: 1.5rem;
            }

            .alert-modern-success {
                background: rgba(25, 135, 84, 0.05);
                border: 1px solid rgba(25, 135, 84, 0.2);
            }

            .alert-modern-warning {
                background: rgba(255, 193, 7, 0.05);
                border: 1px solid rgba(255, 193, 7, 0.2);
            }
        </style>
    @endpush

    <section class="check-hero text-center">
        <div class="hero-pattern"></div>
        <div class="container position-relative z-index-1">
            <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm" data-aos="fade-down">
                <i class="bi bi-search me-2"></i> PELACAKAN TRANSAKSI
            </span>
            <h1 class="display-4 fw-bolder mb-3" data-aos="fade-up">Cek Status Wakaf</h1>
            <p class="fs-5 text-white-50 mx-auto" style="max-width: 600px; line-height: 1.6;" data-aos="fade-up"
                data-aos-delay="100">
                Pantau proses verifikasi dan status pembayaran wakaf Anda secara real-time.
            </p>
        </div>
    </section>

    <section class="py-0 position-relative z-3">
        <div class="container">

            {{-- FORM PENCARIAN --}}
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="search-box-modern" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-center mb-4">
                            <h4 class="fw-bolder" style="color: var(--c-dark);">Masukkan Order ID</h4>
                            <p class="text-muted small">Ketik kode referensi yang Anda dapatkan saat mengisi formulir
                                (Contoh: WKF-12345)</p>
                        </div>

                        <form action="{{ route('donations.check.process') }}" method="POST">
                            @csrf
                            <div class="input-modern-group mb-3">
                                <span class="ps-3 pe-2 text-success"><i class="bi bi-hash fs-4"></i></span>
                                <input type="text" name="order_id"
                                    class="form-control input-modern flex-grow-1 text-uppercase"
                                    placeholder="KODE ORDER..." required value="{{ request('order_id') }}">
                                <button class="btn-search-modern" type="submit">Lacak <i
                                        class="bi bi-arrow-right ms-1"></i></button>
                            </div>

                            @if (session('error'))
                                <div
                                    class="alert alert-danger text-center small py-2 border-0 rounded-3 mt-3 animate__animated animate__shakeX">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            {{-- HASIL PENCARIAN (RECEIPT TICKET) --}}
            @if (isset($donation))
                <div class="row justify-content-center mt-5 mb-5 pb-5">
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="receipt-card">

                            {{-- HEADER STRUK --}}
                            <div class="receipt-header">
                                <div class="mb-4">
                                    @if ($donation->status == 'paid')
                                        <span class="status-badge-lg status-success shadow-sm">
                                            <i class="bi bi-check-circle-fill me-2"></i> BERHASIL
                                        </span>
                                    @elseif($donation->status == 'pending')
                                        <span class="status-badge-lg status-pending shadow-sm">
                                            <i class="bi bi-hourglass-split me-2"></i> MENUNGGU PEMBAYARAN
                                        </span>
                                    @else
                                        <span class="status-badge-lg status-failed shadow-sm">
                                            <i class="bi bi-x-circle-fill me-2"></i> DIBATALKAN / GAGAL
                                        </span>
                                    @endif
                                </div>
                                <h3 class="fw-bolder mb-1"
                                    style="font-family: monospace; letter-spacing: 2px; color: var(--c-dark);">
                                    {{ $donation->order_id }}</h3>
                                <p class="text-muted small mb-0"><i class="bi bi-calendar3 me-1"></i>
                                    {{ $donation->created_at->format('d F Y, H:i') }} WIB</p>
                            </div>

                            {{-- BODY STRUK --}}
                            <div class="receipt-body">
                                <h5 class="fw-bold mb-4" style="color: var(--c-dark);">Rincian Transaksi</h5>

                                <ul class="list-group list-group-custom mb-5">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="text-muted small text-uppercase fw-bold">Nama Donatur</span>
                                        <span class="fw-bolder fs-5 text-dark">{{ $donation->donor_name }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="text-muted small text-uppercase fw-bold">Alamat Email</span>
                                        <span class="fw-bold text-dark">{{ $donation->donor_email }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="text-muted small text-uppercase fw-bold">Jenis Program</span>
                                        <span
                                            class="badge bg-light text-success border px-3 py-2 rounded-pill">{{ $donation->program->category ?? 'Wakaf Uang' }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-start flex-column flex-sm-row gap-2">
                                        <span class="text-muted small text-uppercase fw-bold">Tujuan</span>
                                        <span
                                            class="fw-bold text-dark text-sm-end">{{ $donation->program->title ?? 'Wakaf Uang Tunai Abadi' }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-light rounded-3 px-3 mt-3 border-0">
                                        <span class="text-muted small text-uppercase fw-bold">Total Nominal</span>
                                        <span class="fw-bolder text-success fs-4">Rp
                                            {{ number_format($donation->amount, 0, ',', '.') }}</span>
                                    </li>
                                </ul>

                                {{-- ACTION AREA BERDASARKAN STATUS --}}
                                @if ($donation->status == 'pending')
                                    <div class="alert-modern alert-modern-warning text-center mb-4">
                                        <i class="bi bi-info-circle-fill text-warning fs-3 mb-2 d-block"></i>
                                        <h6 class="fw-bold text-dark">Selesaikan Pembayaran Anda</h6>
                                        <p class="small text-muted mb-4">Jika Anda sudah transfer, mohon tunggu admin
                                            kami memverifikasi mutasi bank (maksimal 1x24 jam). Jika Anda belum
                                            transfer, silakan klik tombol Bayar di bawah.</p>

                                        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                                            <a href="{{ route('donations.instruction', ['order_id' => $donation->order_id]) }}"
                                                class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm">
                                                <i class="bi bi-credit-card me-1"></i> Instruksi Bayar
                                            </a>
                                            <form action="{{ route('donations.cancel', $donation->order_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin membatalkan niat wakaf ini?');">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-outline-danger fw-bold px-4 py-2 rounded-pill w-100">
                                                    Batalkan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="https://wa.me/6281234567890" target="_blank"
                                            class="text-decoration-none fw-bold text-success small"><i
                                                class="bi bi-whatsapp"></i> Konfirmasi ke Admin via WA</a>
                                    </div>
                                @endif

                                @if ($donation->status == 'paid')
                                    <div class="alert-modern alert-modern-success text-center">
                                        <div class="mb-3">
                                            <i class="bi bi-heart-pulse-fill text-success" style="font-size: 3rem;"></i>
                                        </div>
                                        <h5 class="fw-bolder text-dark mb-2">Alhamdulillah, Terima Kasih!</h5>
                                        <p class="small text-muted mb-0 mx-auto"
                                            style="max-width: 400px; line-height: 1.6;">
                                            Wakaf Anda telah berhasil kami verifikasi. <br>
                                            <em>"Semoga Allah SWT menerima amal ibadah Anda, melipatgandakan rezeki, dan
                                                menjadikannya pemberat timbangan kebaikan di akhirat kelak.
                                                Aamiin."</em>
                                        </p>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('donations.check') }}"
                                class="text-decoration-none fw-bold text-muted border-bottom border-secondary pb-1"><i
                                    class="bi bi-arrow-repeat me-1"></i> Cek Order ID Lainnya</a>
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </section>
</x-layouts.app>
