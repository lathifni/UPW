<x-layouts.app>
    <x-slot:title>Cek Status Wakaf</x-slot:title>

   <div class="container py-5" style="margin-top: 80px;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="text-center">
                    <h2 class="fw-bold text-success">Lacak Riwayat Wakaf Anda</h2>
                    <p class="text-muted">Masukkan Order ID yang Anda dapatkan setelah mengisi formulir</p>
                </div>

                {{-- FORM PENCARIAN --}}
                <div class="card shadow-sm border-0 ">
                    <div class="card-body p-4">
                        <form action="{{ route('donations.check.process') }}" method="POST">
                            @csrf
                            <label class="form-label fw-bold">Order ID / Kode Referensi</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                                <input type="text" name="order_id" class="form-control form-control-lg" 
                                       placeholder="Contoh: W-A1B2C3" required 
                                       value="{{ request('order_id') }}"> {{-- Biar gak ilang pas error --}}
                                <button class="btn btn-success fw-bold px-4" type="submit">Cek</button>
                            </div>
                            @if(session('error'))
                                <div class="alert alert-danger small py-2">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- HASIL PENCARIAN (Hanya Muncul Jika Ada Data) --}}
                @if(isset($donation))
                    <div class="card border-success shadow">
                        <div class="card-header bg-success text-white text-center py-3">
                            <h5 class="m-0 fw-bold">Detail Wakaf</h5>
                        </div>
                        <div class="card-body p-4 text-center">
                            
                            {{-- Status Badge --}}
                            <div class="mb-3">
                                @if($donation->status == 'paid')
                                    <span class="badge bg-success fs-5 px-4 py-2 rounded-pill">
                                        <i class="bi bi-check-circle-fill me-2"></i> BERHASIL
                                    </span>
                                @elseif($donation->status == 'pending')
                                   <span class="badge bg-warning text-dark fs-5 px-4 py-2 rounded-pill d-inline-flex align-items-center">
                                        {{-- Spinner Bawaan Bootstrap (Lingkaran Muter) --}}
                                        <div class="spinner-border spinner-border-sm me-2" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        MENUNGGU VERIFIKASI
                                    </span>
                                @else
                                    <span class="badge bg-danger fs-5 px-4 py-2 rounded-pill">
                                        <i class="bi bi-x-circle-fill me-2"></i> GAGAL / DIBATALKAN
                                    </span>
                                @endif
                            </div>

                            <h3 class="fw-bold my-2">{{ $donation->order_id }}</h3>
                            <p class="text-muted mb-4">{{ $donation->created_at->format('d F Y, H:i') }} WIB</p>

                            <ul class="list-group list-group-flush text-start mb-4">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="text-muted">Nama Donatur</span>
                                    <span class="fw-bold">{{ $donation->donor_name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="text-muted">Email Donatur</span>
                                    <span class="fw-bold">{{ $donation->donor_email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="text-muted">Nominal</span>
                                    <span class="fw-bold text-success">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="text-muted">Program</span>
                                    <span class="fw-bold text-end">{{ $donation->program->title ?? 'Umum' }}</span>
                                </li>
                            </ul>

                            @if($donation->status == 'pending')
                                <div class="alert alert-warning small text-start">
                                    <i class="bi bi-info-circle me-1"></i> 
                                    Jika Anda sudah transfer, mohon tunggu admin kami memverifikasi mutasi (maksimal 1x24 jam).
                                    <br><br>
                                    <a href="https://wa.me/6281234567890" class="fw-bold text-dark">Hubungi Admin jika mendesak</a>
                                </div>
                            @endif

                            @if($donation->status == 'paid')
                                <div class="alert alert-success border-0 bg-success-subtle text-dark mb-2">
                                    <div class="mb-1">
                                        {{-- Icon Hati Besar --}}
                                        <i class="bi bi-chat-heart-fill fs-1 text-success"></i>
                                    </div>
                                    <h5 class="fw-bold text-success">Alhamdulillah, Terima Kasih!</h5>
                                    <p class="small mb-0">
                                        Wakaf Anda telah berhasil kami terima. <br>
                                        <em>"Semoga Allah SWT menerima amal ibadah Anda, melipatgandakan rezeki, dan menjadikannya pemberat timbangan kebaikan di akhirat kelak. Aamiin ya Rabbalamin."</em>
                                    </p>

                                    {{-- OPSIONAL: Tombol Download Sertifikat (Kalau nanti sudah ada fiturnya) --}}
                                    {{-- 
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-file-earmark-pdf me-1"></i> Download Sertifikat
                                        </a>
                                    </div> 
                                    --}}
                                </div>
                            @endif

                            <a href="{{ route('donations.check') }}" class="btn btn-outline-secondary btn-sm mt-3">Cari Lainnya</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-layouts.app>