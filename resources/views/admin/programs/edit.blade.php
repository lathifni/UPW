<x-layouts.admin>
    <x-slot:title>Edit Program</x-slot:title>

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Program</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Judul Program</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $program->title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="5">{{ old('description', $program->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="beasiswa"
                            {{ old('category', $program->category) == 'beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                        <option value="zakat" {{ old('category', $program->category) == 'zakat' ? 'selected' : '' }}>
                            Zakat</option>
                        <option value="dana-abadi"
                            {{ old('category', $program->category) == 'dana-abadi' ? 'selected' : '' }}>Dana Abadi
                        </option>
                        <option value="bencana"
                            {{ old('category', $program->category) == 'bencana' ? 'selected' : '' }}>Bantuan Bencana
                        </option>
                        <option value="fasilitas"
                            {{ old('category', $program->category) == 'fasilitas' ? 'selected' : '' }}>Fasilitas Kampus
                        </option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_unggulan" value="1" id="is_unggulan"
                        {{ $program->is_unggulan ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_unggulan">
                        Jadikan Program Unggulan?
                    </label>
                </div>
                <div class="mb-3">
                    <label for="certificate_type" class="form-label">Jenis Sertifikat</label>
                    <select class="form-select" id="certificate_type" name="certificate_type">
                        <option value="none" @if (isset($program) && $program->certificate_type == 'none') selected @endif>
                            Tidak Ada (Default)
                        </option>
                        <option value="sertifikat_standar" @if (isset($program) && $program->certificate_type == 'sertifikat_standar') selected @endif>
                            Sertifikat Standar (Dinamis)
                        </option>
                        <option value="akta_wakaf" @if (isset($program) && $program->certificate_type == 'akta_wakaf') selected @endif>
                            Akta Ikrar Wakaf (Fixed)
                        </option>
                        <option value="surat_apresiasi" @if (isset($program) && $program->certificate_type == 'surat_apresiasi') selected @endif>
                            Surat Apresiasi Rektor (Fixed)
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="target_amount">Target Dana</label>
                    <input type="number" class="form-control @error('target_amount') is-invalid @enderror"
                        id="target_amount" name="target_amount"
                        value="{{ old('target_amount', $program->target_amount) }}">
                    @error('target_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="deadline">Batas Waktu (Opsional)</label>
                    <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline"
                        name="deadline" value="{{ old('deadline', $program->deadline) }}">
                    @error('deadline')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    <div>
                        @if ($program->image)
                            <img src="{{ asset('storage/programs/' . $program->image) }}" alt="Gambar Program"
                            width="150">@else<p>Tidak ada gambar</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Ganti Gambar Program</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                        name="image">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Program</button>
                <a href="{{ route('programs.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-layouts.admin>
