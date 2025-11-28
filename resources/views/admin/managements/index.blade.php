<x-layouts.admin>
    <x-slot:title>Manajemen Pengurus</x-slot:title>
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengurus</h6>
            <a href="{{ route('managements.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i>
                Tambah Pengurus</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Posisi</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($managements as $management)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $management->name }}</td>
                                <td>{{ $management->position }}</td>
                                <td><span class="badge badge-secondary">{{ Str::title($management->level) }}</span></td>
                                <td>
                                    <a href="{{ route('managements.edit', $management->id) }}"
                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('managements.destroy', $management->id) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data pengurus.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
