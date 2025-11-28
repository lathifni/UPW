<x-layouts.admin>
    <x-slot:title>Tambah Pengurus Baru</x-slot:title>
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pengurus</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('managements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="position">Posisi</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                        name="position" value="{{ old('position') }}" placeholder="Cth: Rektor">
                    @error('position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Peran</label>
                    <input type="text" class="form-control @error('role') is-invalid @enderror" id="role"
                        name="role" value="{{ old('role') }}" placeholder="Cth: Penanggung Jawab">
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="level">Level Kepengurusan</label>
                    <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                        <option value="">-- Pilih Level --</option>
                        <option value="penanggung-jawab" {{ old('level') == 'penanggung-jawab' ? 'selected' : '' }}>
                            Penanggung Jawab</option>
                        <option value="dewan-pengawas" {{ old('level') == 'dewan-pengawas' ? 'selected' : '' }}>Dewan
                            Pengawas</option>
                        <option value="anggota-upw" {{ old('level') == 'anggota-upw' ? 'selected' : '' }}>Anggota UPW
                        </option>
                    </select>
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Singkat (Opsional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Foto</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                        name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('managements.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-layouts.admin>
