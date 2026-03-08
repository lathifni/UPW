<x-layouts.admin>
    <x-slot:title>Manajemen Wakaf</x-slot:title>
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Semua Wakaf</h6>
        </div>
        <div class="card-body">

        {{-- === BAGIAN BARU: FORM FILTER & EXPORT === --}}
            <form action="{{ route('admin.donations.export') }}" method="GET" class="mb-4">
                <div class="row align-items-end">

                {{-- 1. Filter Program (NEW) --}}
                    <div class="col-md-4 col-sm-12 mb-2">
                        <label class="small font-weight-bold text-secondary">Nama Program</label>
                        <select name="program_id" class="form-control form-control-sm select2"> <option value="">- Semua Program -</option>
                            @foreach($programs as $prog)
                                <option value="{{ $prog->id }}" {{ request('program_id') == $prog->id ? 'selected' : '' }}>
                                    {{ $prog->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    {{-- Filter Bulan --}}
                    <div class="col-md-3 col-sm-6 mb-2">
                        <label class="small font-weight-bold text-secondary">Bulan</label>
                        <select name="bulan" class="form-control form-control-sm">
                            <option value="">- Semua Bulan -</option>
                            @foreach(range(1, 12) as $m)
                                <option value="{{ sprintf('%02d', $m) }}" {{ request('bulan') == sprintf('%02d', $m) ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Tahun --}}
                    <div class="col-md-2 col-sm-6 mb-2">
                        <label class="small font-weight-bold text-secondary">Tahun</label>
                        <select name="tahun" class="form-control form-control-sm">
                            <option value="">- Semua -</option>
                            
                            {{-- LOOPING DINAMIS DARI CONTROLLER --}}
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                            
                        </select>
                    </div>

                    {{-- Filter Kategori Wakif --}}
                    <div class="col-md-3 col-sm-6 mb-2">
                        <label class="small font-weight-bold text-secondary">Kategori Wakif</label>
                        <select name="donor_category" class="form-control form-control-sm">
                            <option value="">- Semua Kategori -</option>
                            <option value="umum">Umum</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="alumni">Alumni</option>
                            <option value="dosen">Dosen</option>
                            <option value="tenaga_pendidik">Tenaga Pendidik</option>
                        </select>
                    </div>

                    {{-- Tombol Export --}}
                    <div class="col-md-auto mb-2">
                        <button type="submit" class="btn btn-success btn-sm font-weight-bold shadow-sm">
                            <i class="fas fa-file-excel mr-1"></i> Export Excel
                        </button>
                    </div>
                </div>
            </form>
            <hr>
            {{-- === END BAGIAN BARU === --}}

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
                                                
                                                {{-- Form Lunas --}}
                                                <form action="{{ route('admin.donations.status.update', $donation->id) }}" method="POST" class="px-2 form-update-status">
                                                    @csrf
                                                    <input type="hidden" name="status" value="paid">
                                                    <button type="button" 
                                                        class="btn btn-success btn-sm btn-block btn-update-status"
                                                        data-action="LUNAS"
                                                        data-order="{{ $donation->order_id }}"
                                                        data-nama="{{ $donation->user->nama ?? $donation->donor_name }}"
                                                        data-program="{{ $donation->program->title ?? 'Donasi Umum' }}"
                                                        data-jumlah="{{ number_format($donation->amount, 0, ',', '.') }}">
                                                        Tandai Lunas
                                                    </button>
                                                </form>

                                                {{-- Form Gagal --}}
                                                <form action="{{ route('admin.donations.status.update', $donation->id) }}" method="POST" class="px-2 mt-2 form-update-status">
                                                    @csrf
                                                    <input type="hidden" name="status" value="failed">
                                                    <button type="button" 
                                                        class="btn btn-danger btn-sm btn-block btn-update-status"
                                                        data-action="GAGAL"
                                                        data-order="{{ $donation->order_id }}"
                                                        data-nama="{{ $donation->user->nama ?? $donation->donor_name }}"
                                                        data-program="{{ $donation->program->title ?? 'Donasi Umum' }}"
                                                        data-jumlah="{{ number_format($donation->amount, 0, ',', '.') }}">
                                                        Tandai Gagal
                                                    </button>
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

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            document.querySelectorAll('.btn-update-status').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.form-update-status'); // Cari form yang bungkus tombol ini
                    
                    // Ambil data dari atribut HTML
                    const actionType = this.getAttribute('data-action');
                    const orderId = this.getAttribute('data-order');
                    const nama = this.getAttribute('data-nama');
                    const program = this.getAttribute('data-program');
                    const jumlah = this.getAttribute('data-jumlah');

                    // Setel warna tombol sesuai aksi (Lunas = Ijo, Gagal = Merah)
                    const confirmColor = actionType === 'LUNAS' ? '#1cc88a' : '#e74a3b';
                    const iconType = actionType === 'LUNAS' ? 'question' : 'warning';

                    Swal.fire({
                        title: `Tandai sebagai ${actionType}?`,
                        html: `
                            <div class="text-left mt-3 p-3 bg-light rounded border">
                                <strong>Order ID:</strong> ${orderId} <br>
                                <strong>Nama:</strong> ${nama} <br>
                                <strong>Program:</strong> ${program} <br>
                                <strong>Jumlah:</strong> <span class="text-primary font-weight-bold">Rp ${jumlah}</span>
                            </div>
                            <p class="mt-3 mb-0 font-weight-bold text-danger">Pastikan Anda sudah mengecek mutasi bank!</p>
                        `,
                        icon: iconType,
                        showCancelButton: true,
                        confirmButtonColor: confirmColor,
                        cancelButtonColor: '#858796',
                        confirmButtonText: `Ya, Tandai ${actionType}!`,
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit formnya kalau admin milih Yes
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layouts.admin>
