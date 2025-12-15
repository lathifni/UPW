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
                                <input type="text" name="title" class="form-control" placeholder="Contoh: Laporan Keuangan 2024" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Tahun Periode</label>
                                <input type="number" name="year" class="form-control" placeholder="2024" value="{{ date('Y') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">File PDF</label>
                                <input type="file" name="file" class="form-control" accept="application/pdf" required>
                                <small class="text-muted">Format PDF, Maks 5MB.</small>
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
                                                <a href="{{ asset('storage/reports/' . $report->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin hapus laporan ini?');">
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
</x-layouts.admin>