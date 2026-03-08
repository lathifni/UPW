<x-layouts.admin>
    <x-slot:title>Manajemen Rekening</x-slot:title>

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Rekening</h6>
            {{-- Ubah route ke rekenings.create --}}
            <a href="{{ route('rekenings.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle"></i> Tambah Rekening
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Nama Bank</th>
                            <th>Nomor Rekening</th>
                            <th>Atas Nama</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Ubah variable jadi $rekenings --}}
                        @forelse ($rekenings as $rekening)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                
                                {{-- Sesuaikan field ini dengan nama kolom di database kamu --}}
                                <td>{{ $rekening->nama_bank }}</td> 
                                <td class="font-weight-bold">{{ $rekening->nomor_rekening }}</td>
                                <td>{{ $rekening->atas_nama }}</td>

                                <td>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('rekenings.edit', $rekening->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('rekenings.destroy', $rekening->id) }}" method="POST"
                                        class="d-inline delete-form" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <span class="text-muted">Belum ada data rekening bank.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>