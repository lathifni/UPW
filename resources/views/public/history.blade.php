<x-layouts.app>
    <x-slot:title>Portofolio Wakaf Saya</x-slot:title>

    <section class="py-5 bg-light min-vh-100" style="margin-top: 80px;">
        <div class="container">
            
            {{-- 1. HEADING & SEARCH FORM --}}
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Jejak Kebaikan Anda</h2>
                    <p class="text-muted mb-4">
                        Masukkan <strong>Email</strong> atau <strong>No. WhatsApp</strong> (atau NIM) 
                        yang Anda gunakan saat berwakaf untuk melihat seluruh riwayat donasi.
                    </p>

                    <div class="card border-0 shadow-sm p-4 rounded-4">
                        <form action="{{ route('public.wakaf.history') }}" method="GET">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" name="keyword" class="form-control border-start-0" 
                                       placeholder="Contoh: 08123456789 atau email@unand.ac.id" 
                                       value="{{ $keyword ?? '' }}" required>
                                <button class="btn btn-success px-4 fw-bold" type="submit">Cek Riwayat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- 2. HASIL PENCARIAN --}}
            @if(request('keyword'))
                <div class="row justify-content-center" data-aos="fade-up">
                    <div class="col-lg-10">
                        @if($donations->count() > 0)
                            
                            {{-- Ringkasan Total --}}
                            <div class="alert alert-success d-flex justify-content-between align-items-center mb-4 border-0 shadow-sm rounded-3">
                                <div>
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    Ditemukan <strong>{{ $donations->count() }}</strong> riwayat wakaf.
                                </div>
                                <div class="fw-bold fs-5">
                                    Total: Rp{{ number_format($donations->sum('amount'), 0, ',', '.') }}
                                </div>
                            </div>

                            {{-- Tabel Data --}}
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-3 ps-4">Tanggal</th>
                                                <th class="py-3">Program Wakaf</th>
                                                <th class="py-3">Nominal</th>
                                                <th class="py-3">No. Akte (Jika Ada)</th>
                                                <th class="py-3 text-end pe-4">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($donations as $d)
                                                <tr>
                                                    <td class="ps-4 text-muted small">
                                                        {{ $d->created_at?->format('d M Y') }}
                                                    </td>
                                                    <td>
                                                        <span class="fw-bold text-dark d-block">
                                                            {{ $d->program->title ?? 'Wakaf Uang Tunai' }}
                                                        </span>
                                                        <small class="text-muted">{{ $d->order_id }}</small>
                                                    </td>
                                                    <td class="fw-bold text-success">
                                                        Rp{{ number_format($d->amount, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        @if($d->nomor_akte)
                                                            <span class="badge bg-success-subtle text-success border border-success-subtle">
                                                                <i class="bi bi-patch-check-fill me-1"></i> {{ $d->nomor_akte }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted small">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-end pe-4">
                                                        {{-- Tombol Download Sertifikat/Invoice --}}
                                                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">
                                                            <i class="bi bi-download"></i> Bukti
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        @else
                            {{-- Kalau ZONK (Gak ketemu) --}}
                            <div class="text-center py-5">
                                <img src="https://cdni.iconscout.com/illustration/premium/thumb/search-not-found-6275834-5210416.png" 
                                     alt="Not Found" style="width: 150px; opacity: 0.7">
                                <h5 class="mt-3 text-muted">Data tidak ditemukan</h5>
                                <p class="text-muted small">
                                  Pastikan Email, No. HP, atau NIM yang dimasukkan sesuai dengan data saat berwakaf
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </section>
</x-layouts.app>