<x-layouts.admin>
    <x-slot:title>Tambah Artikel Baru</x-slot:title>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" />
        <style>
            .preview-img {
                height: 100px;
                width: 100px;
                object-fit: cover;
                border-radius: 8px;
                border: 2px solid #e3e6f0;
                padding: 2px;
            }
        </style>
    @endpush

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Artikel</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Judul Artikel</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category" class="font-weight-bold">Kategori</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="beasiswa" {{ old('category') == 'beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                        <option value="zakat" {{ old('category') == 'zakat' ? 'selected' : '' }}>Zakat</option>
                        <option value="bencana" {{ old('category') == 'bencana' ? 'selected' : '' }}>Bencana</option>
                        <option value="pengembangan" {{ old('category') == 'pengembangan' ? 'selected' : '' }}>Pengembangan</option>
                        <option value="laporan" {{ old('category') == 'laporan' ? 'selected' : '' }}>Laporan</option>
                        <option value="event" {{ old('category') == 'event' ? 'selected' : '' }}>Event</option>
                        <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content-editor" class="font-weight-bold">Isi Konten</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content-editor" name="content" rows="10">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Gambar Utama (Thumbnail) --}}
                    <div class="col-md-6 mb-3">
                        <div class="form-group border p-3 rounded bg-light h-100 mb-0">
                            <label for="image" class="font-weight-bold text-primary"><i class="fas fa-image mr-1"></i> Gambar Utama (Thumbnail)</label>
                            
                            {{-- Wadah Preview Gambar Utama --}}
                            <div class="mb-2 text-center mt-2">
                                <img id="preview-thumbnail" class="img-fluid rounded border p-2 bg-white" style="max-height: 120px; display: none;">
                            </div>

                            <input type="file" class="form-control-file mt-2 @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            <small class="text-muted d-block mt-2">Gambar ini akan jadi *cover* utama artikel.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Gambar Tambahan (Max 5) --}}
                    <div class="col-md-6 mb-3">
                        <div class="form-group border p-3 rounded bg-light h-100 mb-0">
                            <label for="additional_images" class="font-weight-bold text-success"><i class="fas fa-images mr-1"></i> Gambar Tambahan (Max 5 Foto)</label>
                            
                            {{-- Wadah untuk nampilin preview banyak gambar --}}
                            <div id="preview-container" class="d-flex flex-wrap gap-2 mt-2"></div>

                            <input type="file" class="form-control-file mt-2 @error('additional_images.*') is-invalid @enderror" 
                                id="additional_images" name="additional_images[]" accept="image/*" multiple>
                            <small class="text-muted d-block mt-2">Tahan tombol <b>CTRL</b> untuk memilih banyak foto sekaligus.</small>
                            
                            @error('additional_images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Artikel</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"></script>
        {{-- Masukin SweetAlert2 buat notif kalau lebih dari 5 file --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            // 1. Inisialisasi Trumbowyg
            $('#content-editor').trumbowyg();

            // 2. Logic Preview Thumbnail (Gambar Utama)
            const thumbnailInput = document.getElementById('image');
            const thumbnailPreview = document.getElementById('preview-thumbnail');

            thumbnailInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        thumbnailPreview.style.display = 'inline-block';
                        thumbnailPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    thumbnailPreview.style.display = 'none';
                    thumbnailPreview.src = '';
                }
            });

            // 3. Logic Preview & Limit 5 Gambar Tambahan
            const fileInput = document.getElementById('additional_images');
            const previewContainer = document.getElementById('preview-container');

            fileInput.addEventListener('change', function () {
                // Bersihin preview lama tiap kali user milih file baru
                previewContainer.innerHTML = ''; 

                // Cek kalau lebih dari 5
                if (this.files.length > 5) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kebanyakan, Bro!',
                        text: 'Maksimal cuma boleh pilih 5 foto tambahan ya.',
                    });
                    this.value = ''; // Reset inputan
                    return;
                }

                // Munculin preview gambarnya satu-satu
                Array.from(this.files).forEach(file => {
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'preview-img shadow-sm mb-2 mr-2';
                            previewContainer.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    @endpush
</x-layouts.admin>