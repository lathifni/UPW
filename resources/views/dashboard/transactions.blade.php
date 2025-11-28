<x-layouts.dashboard>
    <x-slot:title>Riwayat Transaksi - Dana Sosial UNAND</x-slot:title>

    <x-slot:hero_content>
        <h1 class="h3 mb-2 fw-bold" style="padding-top: 70px;">Riwayat Transaksi</h1>
        <p class="mb-0 opacity-75">Pantau semua transaksi dan status pembayaran donasi Anda.</p>
    </x-slot:hero_content>

    @push('styles')
        <style>
            .transaction-card {
                background: white;
                border-radius: 1rem;
                padding: 1.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 1px solid #e9ecef;
                margin-bottom: 1rem;
                transition: all 0.3s ease;
            }

            .transaction-card:hover {
                transform: translateY(-3px);
            }

            .status-badge {
                font-size: 0.75rem;
                padding: 0.35em 0.65em;
                border-radius: 2rem;
            }

            .transaction-icon {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.25rem;
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
        {{-- TODO: Fungsikan filter ini nanti --}}
    </div>

    <div class="transaction-list">
        @forelse ($transactions as $transaction)
            <div class="transaction-card">
                <div class="row align-items-center">
                    <div class="col-md-1">
                        @if ($transaction->status == 'paid')
                            <div class="transaction-icon bg-success bg-opacity-10 text-success"><i
                                    class="bi bi-check-circle"></i></div>
                        @elseif($transaction->status == 'pending')
                            <div class="transaction-icon bg-warning bg-opacity-10 text-warning"><i
                                    class="bi bi-clock"></i></div>
                        @else
                            <div class="transaction-icon bg-danger bg-opacity-10 text-danger"><i
                                    class="bi bi-x-circle"></i></div>
                        @endif
                    </div>
                    <div class="col-md-5">
                        <h6 class="mb-1 fw-bold">{{ $transaction->program->title ?? 'Donasi Umum' }}</h6>
                        <div class="d-flex flex-wrap gap-2 align-items-center mb-1">
                            <span class="text-muted small">{{ $transaction->order_id }}</span>
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-calendar me-1"></i>{{ $transaction->created_at->format('d M Y, H:i') }} WIB
                        </small>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-success mb-0">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</h5>
                    </div>
                    <div class="col-md-3 text-end">
                        @if ($transaction->status == 'paid')
                            <span class="status-badge bg-success">Berhasil</span>
                        @elseif($transaction->status == 'pending')
                            <span class="status-badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="status-badge bg-danger">Gagal</span>
                        @endif
                        <div class="mt-2">
                            <button class="btn btn-outline-success btn-sm"><i class="bi bi-receipt"></i>
                                Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="transaction-card text-center">
                <p class="text-muted mb-0">Anda belum memiliki riwayat transaksi.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>

</x-layouts.dashboard>
