<x-layouts.admin>
    <x-slot:title>Manajemen Wakaf</x-slot:title>
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Semua Wakaf</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Donatur</th>
                            <th>Program</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donations as $donation)
                            <tr>
                                <td>{{ $donation->order_id }}</td>
                                <td>{{ $donation->user->nama ?? $donation->donor_name }}</td>
                                <td>{{ $donation->program->title ?? 'Donasi Umum' }}</td>
                                <td>Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                <td>
                                    @if ($donation->status == 'paid')
                                        <span class="badge badge-success">Paid</span>
                                    @elseif($donation->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-danger">Failed</span>
                                    @endif
                                </td>
                                <td>{{ $donation->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            data-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- Tombol Lihat Detail (selalu ada) --}}
                                            <a class="dropdown-item"
                                                href="{{ route('admin.donations.show', $donation->id) }}">Lihat
                                                Detail</a>

                                            {{-- Tombol Ubah Status (hanya jika pending) --}}
                                            @if ($donation->status == 'pending')
                                                <div class="dropdown-divider"></div>
                                                <form
                                                    action="{{ route('admin.donations.status.update', $donation->id) }}"
                                                    method="POST" class="px-2"
                                                    onsubmit="return confirm('Anda yakin ingin menandai donasi ini sebagai LUNAS?');">
                                                    @csrf
                                                    <input type="hidden" name="status" value="paid">
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm btn-block">Tandai Lunas</button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.donations.status.update', $donation->id) }}"
                                                    method="POST" class="px-2 mt-2"
                                                    onsubmit="return confirm('Anda yakin ingin menandai donasi ini sebagai GAGAL?');">
                                                    @csrf
                                                    <input type="hidden" name="status" value="failed">
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm btn-block">Tandai Gagal</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data donasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $donations->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
