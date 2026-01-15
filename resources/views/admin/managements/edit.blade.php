
<x-layouts.admin>
    <x-slot:title>Edit Data Pengurus</x-slot:title>
    
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Pengurus</h6>
        </div>
        <div class="card-body">
            {{-- Pastikan enctype="multipart/form-data" ada agar bisa upload file --}}
            <form action="{{ route('managements.update', $management->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $management->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Posisi --}}
                <div class="form-group">
                    <label for="position">Posisi</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                        name="position" value="{{ old('position', $management->position) }}" placeholder="Cth: Rektor">
                    @error('position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="form-group">
                    <label for="role">Peran</label>
                    <input type="text" class="form-control @error('role') is-invalid @enderror" id="role"
                        name="role" value="{{ old('role', $management->role) }}" placeholder="Cth: Penanggung Jawab">
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Level --}}
                <div class="form-group">
                    <label for="level">Level Kepengurusan</label>
                    <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                        <option value="">-- Pilih Level --</option>
                        <option value="penanggung-jawab" {{ old('level', $management->level) == 'penanggung-jawab' ? 'selected' : '' }}>
                            Penanggung Jawab
                        </option>
                        <option value="dewan-pengawas" {{ old('level', $management->level) == 'dewan-pengawas' ? 'selected' : '' }}>
                            Dewan Pengawas
                        </option>
                        <option value="anggota-upw" {{ old('level', $management->level) == 'anggota-upw' ? 'selected' : '' }}>
                            Anggota UPW
                        </option>
                    </select>
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description">Deskripsi Singkat (Opsional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="3">{{ old('description', $management->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BAGIAN FOTO (DIPERBAIKI) --}}
                <div class="form-group row">
                    <div class="col-sm-2">Foto Saat Ini/Baru</div>
                    <div class="col-sm-10">
                        <div class="mb-3">
                            {{-- Logic untuk menampilkan gambar: Jika ada manajemen image, tampilkan. Jika tidak, pakai placeholder --}}
                            @if ($management->image)
                                <img src="{{ asset('storage/managements/' . $management->image) }}" 
                                     alt="Preview Foto" 
                                     class="img-thumbnail img-preview" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                {{-- Placeholder jika belum ada foto --}}
                                <img class="img-thumbnail img-preview" 
                                     style="width: 150px; height: 150px; object-fit: cover; display: none;"> 
                                <p class="text-muted no-image-text">Belum ada foto</p>
                            @endif
                        </div>

                        <div class="custom-file">
                            {{-- Tambahkan onchange="previewImage()" --}}
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                                   id="image" name="image" onchange="previewImage()">
                            
                            <small class="form-text text-muted mt-2">
                                Format: JPG, JPEG, PNG. Maks: 2MB. Kosongkan jika tidak ingin mengubah foto.
                            </small>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">Update Data</button>
                <a href="{{ route('managements.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    {{-- Script Javascript untuk Preview Image --}}
    @push('scripts') {{-- Asumsi layout admin kamu punya @stack('scripts') di footer --}}
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            const noImageText = document.querySelector('.no-image-text');

            // Cek apakah ada file yang dipilih
            if (image.files && image.files[0]) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                    imgPreview.style.display = 'block'; // Munculkan gambar
                    
                    if(noImageText) {
                        noImageText.style.display = 'none'; // Sembunyikan teks "Belum ada foto"
                    }
                }
            }
        }
    </script>
    @endpush

    {{-- Jika layout admin tidak pakai @stack, pakai <script> biasa di bawah ini --}}
    {{-- 
    <script>
       // Copy fungsi previewImage di atas ke sini jika @push tidak jalan
    </script> 
    --}}
</x-layouts.admin>