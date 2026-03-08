<x-layouts.admin>
    <x-slot:title>Detail Donasi #{{ $donation->order_id }}</x-slot:title>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Donasi #{{ $donation->order_id }}</h6>
                    
                    <div>
                        {{-- Tombol Ubah ke Pending (Hanya muncul jika Paid atau Failed) --}}
                        @if ($donation->status == 'paid' || $donation->status == 'failed')
                            <form action="{{ route('admin.donations.revert', $donation->id) }}" method="POST" class="d-inline revert-form mr-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning btn-sm text-dark font-weight-bold">
                                    <i class="fas fa-undo me-1"></i> Ubah ke Pending
                                </button>
                            </form>
                        @endif

                        @if ($donation->status == 'paid' && $donation->program->certificate_type != 'none')
                            @if ($donation->certificate_path)
                                {{-- 1. Jika sertifikat SUDAH ada --}}
                                <a href="{{ asset('storage/' . $donation->certificate_path) }}" target="_blank"
                                    class="btn btn-sm btn-outline-success mr-1">
                                    <i class="bi bi-download me-1"></i> Lihat Sertifikat
                                </a>
                            @else
                                {{-- 2. Jika sertifikat BELUM ada --}}
                                <a href="{{ route('admin.donations.generate_certificate', $donation) }}"
                                    class="btn btn-sm btn-success mr-1">
                                    <i class="bi bi-award me-1"></i> Generate Sertifikat
                                </a>
                            @endif
                        @endif

                        <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
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
                                        @else
                                            <span class="badge badge-danger">Failed</span>
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

    {{-- Script untuk SweetAlert --}}
    @push('scripts')
        {{-- Masukin script CDN ini kalau di layout utama lu belum ada SweetAlert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.querySelectorAll('.revert-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); 
                    
                    Swal.fire({
                        title: 'Kembalikan ke Pending?',
                        text: "Status donasi akan diubah menjadi Pending. Pastikan Anda sudah mengecek mutasi rekening!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#f6c23e', // Warna kuning admin
                        cancelButtonColor: '#858796', // Warna abu-abu
                        confirmButtonText: 'Ya, Ubah Status!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            });
        </script>
    @endpush
</x-layouts.admin>