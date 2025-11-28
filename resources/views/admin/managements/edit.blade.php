<x-layouts.admin>
    <x-slot:title>Edit Data Pengurus</x-slot:title>
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Pengurus</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('managements.update', $management->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $management->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="position">Posisi</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                        name="position" value="{{ old('position', $management->position) }}" placeholder="Cth: Rektor">
                    @error('position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Peran</label>
                    <input type="text" class="form-control @error('role') is-invalid @enderror" id="role"
                        name="role" value="{{ old('role', $management->role) }}" placeholder="Cth: Penanggung Jawab">
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="level">Level Kepengurusan</label>
                    <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                        <option value="">-- Pilih Level --</option>
                        <option value="penanggung-jawab"
                            {{ old('level', $management->level) == 'penanggung-jawab' ? 'selected' : '' }}>Penanggung
                            Jawab</option>
                        <option value="dewan-pengawas"
                            {{ old('level', $management->level) == 'dewan-pengawas' ? 'selected' : '' }}>Dewan Pengawas
                        </option>
                        <option value="anggota-upw"
                            {{ old('level', $management->level) == 'anggota-upw' ? 'selected' : '' }}>Anggota UPW
                        </option>
                    </select>
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Singkat (Opsional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="3">{{ old('description', $management->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto Saat Ini</label>
                    <div>
                        @if ($management->image)
                            <img src="{{ asset('storage/managements/' . $management->image) }}" alt="Foto"
                                width="100">
                        @else
                            <p>Tidak ada foto</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Ganti Foto</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                        name="image">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('managements.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-layouts.admin>
