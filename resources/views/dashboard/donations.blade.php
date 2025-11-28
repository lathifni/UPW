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
                {{-- TODO: Fungsikan filter ini nanti --}}
                <div class="d-flex gap-2 justify-content-md-end flex-wrap">
                    <select class="form-select form-select-sm" style="width: auto">
                        <option>Semua Program</option>
                    </select>
                    <select class="form-select form-select-sm" style="width: auto">
                        <option>Semua Status</option>
                    </select>
                    <button class="btn btn-outline-success btn-sm"><i class="bi bi-funnel"></i> Filter</button>
                </div>
            </div>
        </div>
    </div>

    <div class="donation-list">
        @forelse ($donations as $donation)
            <div class="donation-card">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="bi bi-heart-fill text-success display-6"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-2">{{ $donation->program->title ?? 'Donasi Umum' }}</h5>
                        <div class="d-flex flex-wrap gap-3 mb-2">
                            <span class="text-muted"><i
                                    class="bi bi-calendar me-1"></i>{{ $donation->created_at->format('d M Y') }}</span>
                            <span class="text-muted"><i
                                    class="bi bi-clock me-1"></i>{{ $donation->created_at->format('H:i') }} WIB</span>
                            <span class="badge bg-success">Berhasil</span>
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
                                <li><a class="dropdown-item"
                                        href="{{ route('programs.show.public', $donation->program->id) }}"><i
                                            class="bi bi-eye me-2"></i>Lihat Program</a></li>
                                <li><a class="dropdown-item" href="#"><i
                                            class="bi bi-receipt me-2"></i>Invoice</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="donation-card text-center">
                <p class="text-muted mb-0">Anda belum memiliki riwayat donasi. Mari mulai berdonasi!</p>
                <a href="{{ route('programs.index.public') }}" class="btn btn-success mt-3">Mulai Donasi</a>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $donations->links() }}
    </div>

</x-layouts.dashboard>
