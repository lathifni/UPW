<x-layouts.admin>
    <x-slot:title>Detail Donasi #{{ $donation->order_id }}</x-slot:title>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Donasi #{{ $donation->order_id }}</h6>
                    @if ($donation->status == 'paid' && $donation->program->certificate_type != 'none')

                        @if ($donation->certificate_path)
                            {{-- 1. Jika sertifikat SUDAH ada --}}
                            <a href="{{ asset('storage/' . $donation->certificate_path) }}" target="_blank"
                                class="btn btn-sm btn-outline-success">
                                <i class="bi bi-download me-1"></i> Download Sertifikat
                            </a>
                        @else
                            {{-- 2. Jika sertifikat BELUM ada --}}
                            <a href="{{ route('admin.donations.generate_certificate', $donation) }}"
                                class="btn btn-sm btn-success">
                                <i class="bi bi-award me-1"></i> Generate Sertifikat
                            </a>
                        @endif

                    @endif
                    <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary btn-sm"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Detail Transaksi</h5>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th>Order ID</th>
                                    <td>{{ $donation->order_id }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ $donation->created_at->translatedFormat('d F Y, H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <td><strong>Rp {{ number_format($donation->amount, 0, ',', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($donation->status == 'paid')
                                            <span class="badge badge-success">Paid</span>
                                        @elseif($donation->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @else<span class="badge badge-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Detail Program</h5>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th>Nama Program</th>
                                    <td>{{ $donation->program->title ?? 'Donasi Umum' }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ Str::title($donation->program->category ?? '-') }}</td>
                                </tr>
                            </table>
                            <h5 class="mt-4">Detail Donatur</h5>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $donation->user->nama ?? 'Donatur Anonim' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $donation->user->email ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
