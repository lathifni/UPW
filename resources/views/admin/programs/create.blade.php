<x-layouts.admin>
    <x-slot:title>Tambah Program Baru</x-slot:title>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Program</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Judul --}}
                <div class="form-group">
                    <label for="title">Judul Program</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}" placeholder="Masukkan nama program...">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="beasiswa" {{ old('category') == 'beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                        <option value="zakat" {{ old('category') == 'zakat' ? 'selected' : '' }}>Zakat</option>
                        <option value="dana-abadi" {{ old('category') == 'dana-abadi' ? 'selected' : '' }}>Dana Abadi</option>
                        <option value="bencana" {{ old('category') == 'bencana' ? 'selected' : '' }}>Bantuan Bencana</option>
                        <option value="fasilitas" {{ old('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas Kampus</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Checkbox Unggulan --}}
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_unggulan" value="1" id="is_unggulan" {{ old('is_unggulan') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_unggulan">
                        Jadikan Program Unggulan?
                    </label>
                </div>

                {{-- Jenis Sertifikat --}}
                <div class="form-group mb-3">
                    <label for="certificate_type" class="form-label">Jenis Sertifikat</label>
                    <select class="form-control" id="certificate_type" name="certificate_type">
                        <option value="none">Tidak Ada (Default)</option>
                        <option value="sertifikat_standar">Sertifikat Standar (Dinamis)</option>
                        <option value="akta_wakaf">Akta Ikrar Wakaf (Fixed)</option>
                        <option value="surat_apresiasi">Surat Apresiasi Rektor (Fixed)</option>
                    </select>
                </div>

                {{-- Target & Deadline --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="target_amount">Target Dana</label>
                            <input type="number" class="form-control @error('target_amount') is-invalid @enderror"
                                id="target_amount" name="target_amount" value="{{ old('target_amount', 0) }}">
                            @error('target_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="deadline">Batas Waktu (Opsional)</label>
                            <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline"
                                name="deadline" value="{{ old('deadline') }}">
                            @error('deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- INPUT GAMBAR DENGAN PREVIEW --}}
                <div class="form-group">
                    <label for="image">Gambar Program</label>
                    
                    {{-- Area Preview Gambar --}}
                    <div class="mb-3">
                        <img id="img-preview" class="img-fluid rounded border p-1" style="max-height: 200px; display: none;">
                    </div>

                    {{-- Input File --}}
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                        name="image" onchange="previewImage()">
                    
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Program
                    </button>
                    <a href="{{ route('programs.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Script JavaScript untuk Preview Gambar --}}
    @push('scripts')
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('#img-preview');

            // Cek apakah ada file yang dipilih
            if (image.files && image.files[0]) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.style.display = 'block'; // Tampilkan gambar
                    imgPreview.src = oFREvent.target.result; // Isi src gambar
                }
            }
        }
    </script>
    @endpush

</x-layouts.admin>