<x-layouts.dashboard>
    <x-slot:title>Donasi Saya</x-slot:title>

    <x-slot:hero_content>
        <h1 class="h3 mb-2 fw-bold" style="padding-top: 70px;">Donasi Saya</h1>
        <p class="mb-0 opacity-75">Kelola dan pantau semua donasi yang telah Anda berikan.</p>
    </x-slot:hero_content>

    @push('styles')
        <style>
            .donation-card {
                background: white;
                border-radius: 1rem;
                padding: 1.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 1px solid #e9ecef;
                margin-bottom: 1.5rem;
            }

            .filter-section {
                background: white;
                border-radius: 1rem;
                padding: 1.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                margin-bottom: 1.5rem;
            }
        </style>
    @endpush

    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">Semua Donasi</h5>
            </div>
            <div class="col-md-6">
                <form action="{{ route('dashboard.donations') }}" method="GET"
                    class="d-flex gap-2 justify-content-md-end flex-wrap">

                    <select name="category" class="form-select form-select-sm" style="width: auto"
                        onchange="this.form.submit()">
                        <option value="all">Semua Kategori</option>
                        <option value="Wakaf Uang" {{ request('category') == 'Wakaf Uang' ? 'selected' : '' }}>Wakaf
                            Uang</option>
                        <option value="Wakaf Melalui Uang"
                            {{ request('category') == 'Wakaf Melalui Uang' ? 'selected' : '' }}>Wakaf Melalui Uang
                        </option>
                        <option value="Dana Abadi" {{ request('category') == 'Dana Abadi' ? 'selected' : '' }}>Dana
                            Abadi</option>
                        <option value="Zakat" {{ request('category') == 'Zakat' ? 'selected' : '' }}>Zakat</option>
                    </select>

                    <select name="status" class="form-select form-select-sm" style="width: auto"
                        onchange="this.form.submit()">
                        <option value="all">Semua Status</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Berhasil</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>

                </form>
            </div>
        </div>
    </div>

    <div class="donation-list">
        @forelse ($donations as $donation)
            <div class="donation-card">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        {{-- Cek apakah program memiliki gambar --}}
                        @if ($donation->program && $donation->program->image)
                            <img src="{{ asset('storage/programs/' . $donation->program->image) }}"
                                alt="{{ $donation->program->title }}" class="img-fluid rounded shadow-sm"
                                style="height: 90px; width: 100%; object-fit: cover;">
                        @else
                            {{-- Fallback: Kalau nggak ada gambar, tetep nampilin icon love --}}
                            <div class="bg-success bg-opacity-10 rounded d-flex align-items-center justify-content-center shadow-sm"
                                style="height: 90px;">
                                <i class="bi bi-heart-fill text-success display-6"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-2">{{ $donation->program->title ?? 'Donasi Umum' }}</h5>
                        <div class="d-flex flex-wrap gap-3 mb-2">
                            <span class="text-muted"><i
                                    class="bi bi-calendar me-1"></i>{{ $donation->created_at->format('d M Y') }}</span>
                            <span class="text-muted"><i
                                    class="bi bi-clock me-1"></i>{{ $donation->created_at->format('H:i') }} WIB</span>

                            {{-- BADGE STATUS DINAMIS --}}
                            @if ($donation->status == 'paid')
                                <span class="badge bg-success">Berhasil</span>
                            @elseif($donation->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Gagal</span>
                            @endif
                        </div>
                        <p class="text-muted mb-0">{{ Str::limit($donation->program->description ?? '', 100) }}</p>
                    </div>
                    <div class="col-md-2 text-center">
                        <h4 class="text-success mb-0">Rp {{ number_format($donation->amount, 0, ',', '.') }}</h4>
                        <small class="text-muted">One-time</small>
                    </div>
                    <div class="col-md-2 text-end">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">Aksi</button>
                            <ul class="dropdown-menu">
                                @php
                                    $routeName =
                                        $donation->program?->category == 'Wakaf Melalui Uang'
                                            ? 'wakaf-melalui-uang.show.public'
                                            : 'wakaf-uang.show.public';
                                @endphp
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route($routeName, $donation->program?->slug ?? '') }}">
                                        <i class="bi bi-eye me-2"></i>Lihat Program
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('dashboard.donations.invoice', $donation->order_id) }}">
                                        <i class="bi bi-receipt me-2"></i>Download Invoice
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="donation-card text-center">
                <p class="text-muted mb-0">Anda belum memiliki riwayat donasi. Mari mulai berdonasi!</p>
                <a href="{{ route('public.wakaf-uang') }}" class="btn btn-success mt-3">Mulai Donasi</a>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $donations->links() }}
    </div>

</x-layouts.dashboard>
