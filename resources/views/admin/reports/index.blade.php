<x-layouts.admin>
    <x-slot:title>Laporan</x-slot:title>
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Manajemen Laporan & Transparansi</h1>

        <div class="row">
            
            {{-- 1. FORM UPLOAD (Kiri) --}}
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-primary">Upload Laporan Baru</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Judul Laporan</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Contoh: Laporan Keuangan 2024" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Tahun Periode</label>
                                <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" placeholder="2024" value="{{ old('year', date('Y')) }}" required>
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">File PDF</label>
                                <input type="file" name="file" id="report_file" class="form-control @error('file') is-invalid @enderror" accept="application/pdf" required>
                                <small class="text-muted">Format PDF, Maks 5MB.</small>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold">
                                <i class="fas fa-cloud-upload-alt me-1"></i> Upload File
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- 2. TABEL DAFTAR FILE (Kanan) --}}
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-primary">Daftar Laporan Terpublikasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Judul Laporan</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reports as $report)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $report->year }}</td>
                                            <td>{{ $report->title }}</td>
                                            <td class="text-center">
                                                <a href="{{ asset('storage/reports/' . $report->file_path) }}" target="_blank" class="btn btn-sm btn-info text-white">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                Belum ada laporan yang diupload.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        {{-- Load SweetAlert2 buat UI notifikasi yang keren --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            // 1. Validasi Ukuran File (Max 5MB)
            document.getElementById('report_file').addEventListener('change', function() {
                const file = this.files[0];
                
                if (file) {
                    // Cek ukurannya (dalam byte). 5MB = 5 * 1024 * 1024 = 5242880
                    if (file.size > 5242880) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Terlalu Besar!',
                            text: 'Ukuran file PDF tidak boleh lebih dari 5MB.',
                            confirmButtonColor: '#4e73df'
                        });
                        
                        // Kosongin inputannya biar admin gak bisa submit
                        this.value = '';
                    } else if (file.type !== 'application/pdf') {
                        // Tambahan: Cegah admin yang iseng rename JPG jadi PDF
                        Swal.fire({
                            icon: 'error',
                            title: 'Format Salah!',
                            text: 'Hanya file dengan ekstensi .pdf yang diizinkan.',
                            confirmButtonColor: '#4e73df'
                        });
                        
                        this.value = '';
                    }
                }
            });

            // 2. SweetAlert2 buat Konfirmasi Hapus Data (Biar Gak "Localhost Says" lagi)
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); 

                    Swal.fire({
                        title: 'Yakin hapus laporan ini?',
                        text: "File PDF yang terkait juga akan ikut terhapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e74a3b', 
                        cancelButtonColor: '#858796', 
                        confirmButtonText: 'Ya, Hapus!',
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