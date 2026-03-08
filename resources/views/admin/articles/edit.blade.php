<x-layouts.admin>
    <x-slot:title>Edit Artikel</x-slot:title>

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
            .old-img-container {
                position: relative;
                display: inline-block;
            }
        </style>
    @endpush

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Artikel</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Judul Artikel</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $article->title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category" class="font-weight-bold">Kategori</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="beasiswa" {{ old('category', $article->category) == 'beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                        <option value="zakat" {{ old('category', $article->category) == 'zakat' ? 'selected' : '' }}>Zakat</option>
                        <option value="bencana" {{ old('category', $article->category) == 'bencana' ? 'selected' : '' }}>Bencana</option>
                        <option value="pengembangan" {{ old('category', $article->category) == 'pengembangan' ? 'selected' : '' }}>Pengembangan</option>
                        <option value="laporan" {{ old('category', $article->category) == 'laporan' ? 'selected' : '' }}>Laporan</option>
                        <option value="event" {{ old('category', $article->category) == 'event' ? 'selected' : '' }}>Event</option>
                        <option value="lainnya" {{ old('category', $article->category) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content-editor" class="font-weight-bold">Isi Konten</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content-editor" name="content" rows="10">{{ old('content', $article->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- ================= GAMBAR UTAMA ================= --}}
                    <div class="col-md-6 mb-3">
                        <div class="form-group border p-3 rounded bg-light h-100 mb-0">
                            <label class="font-weight-bold text-primary"><i class="fas fa-image mr-1"></i> Gambar Utama (Thumbnail)</label>
                            
                            {{-- Tampilkan Gambar Lama --}}
                            <div class="mb-3 mt-2 text-center">
                                @if ($article->image)
                                    <p class="small text-muted mb-1">Gambar saat ini:</p>
                                    <img src="{{ asset('storage/articles/' . $article->image) }}" class="img-fluid rounded border p-2 bg-white" style="max-height: 120px;" alt="Gambar Saat Ini">
                                @else
                                    <span class="badge badge-secondary">Belum ada gambar utama</span>
                                @endif
                            </div>

                            {{-- Preview Gambar Baru (Disembunyikan awalnya) --}}
                            <div class="mb-2 text-center" id="preview-thumbnail-container" style="display: none;">
                                <p class="small text-success fw-bold mb-1">Preview Gambar Baru:</p>
                                <img id="preview-thumbnail" class="img-fluid rounded border p-2 bg-white" style="max-height: 120px;">
                            </div>

                            <input type="file" class="form-control-file mt-2 @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            <small class="text-muted d-block mt-2">Kosongkan jika tidak ingin mengubah gambar utama.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- ================= GAMBAR TAMBAHAN (MAX 5) ================= --}}
                    <div class="col-md-6 mb-3">
                        <div class="form-group border p-3 rounded bg-light h-100 mb-0">
                            <label class="font-weight-bold text-success"><i class="fas fa-images mr-1"></i> Gambar Tambahan (Max 5 Foto)</label>
                            
                            {{-- Tampilkan Gambar Lama (Kalau ada) --}}
                            @if(!empty($article->additional_images) && count($article->additional_images) > 0)
                                <div class="mb-3 p-2 border rounded bg-white">
                                    <p class="small text-muted mb-2 font-weight-bold">Gambar saat ini <span class="text-danger">(Centang untuk menghapus)</span>:</p>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($article->additional_images as $index => $img)
                                            <div class="old-img-container text-center border p-1 rounded shadow-sm mr-2 mb-2">
                                                <img src="{{ asset('storage/articles/additional/' . $img) }}" class="preview-img mb-1">
                                                <div class="custom-control custom-checkbox mt-1">
                                                    <input type="checkbox" class="custom-control-input delete-img-cb" id="del_{{ $index }}" name="delete_images[]" value="{{ $img }}">
                                                    <label class="custom-control-label small text-danger font-weight-bold" style="cursor: pointer;" for="del_{{ $index }}">Hapus</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Input Gambar Baru --}}
                            <p class="small text-dark font-weight-bold mb-1 mt-3">Upload Gambar Tambahan Baru:</p>
                            
                            {{-- Wadah Preview --}}
                            <div id="preview-container" class="d-flex flex-wrap gap-2 mt-2"></div>

                            <input type="file" class="form-control-file mt-2 @error('new_additional_images.*') is-invalid @enderror" 
                                id="additional_images" name="new_additional_images[]" accept="image/*" multiple>
                            <small class="text-muted d-block mt-2">Tahan tombol <b>CTRL</b> untuk memilih banyak foto sekaligus.</small>
                            
                            @error('new_additional_images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Artikel</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            // 1. Inisialisasi Trumbowyg
            $('#content-editor').trumbowyg();

            // 2. Logic Preview Thumbnail (Gambar Utama)
            const thumbnailInput = document.getElementById('image');
            const thumbnailPreview = document.getElementById('preview-thumbnail');
            const thumbnailContainer = document.getElementById('preview-thumbnail-container');

            thumbnailInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        thumbnailContainer.style.display = 'block';
                        thumbnailPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    thumbnailContainer.style.display = 'none';
                    thumbnailPreview.src = '';
                }
            });

            // 3. Logic Preview & Limit Gambar Tambahan (Canggih)
            const fileInput = document.getElementById('additional_images');
            const previewContainer = document.getElementById('preview-container');
            const deleteCheckboxes = document.querySelectorAll('.delete-img-cb');
            
            // Hitung gambar lama dari database
            const totalOldImages = {{ is_array($article->additional_images) ? count($article->additional_images) : 0 }};

            fileInput.addEventListener('change', function () {
                previewContainer.innerHTML = ''; 

                // Hitung berapa gambar lama yang dicentang buat dihapus
                let totalDeleted = 0;
                deleteCheckboxes.forEach(cb => {
                    if (cb.checked) totalDeleted++;
                });

                // Hitung sisa kuota (Max 5 - (Gambar Lama - Gambar Dihapus))
                let currentActiveImages = totalOldImages - totalDeleted;
                let availableSlot = 5 - currentActiveImages;

                if (this.files.length > availableSlot) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Batas Kuota Penuh!',
                        text: `Sisa kuota gambar tambahan Anda tinggal ${availableSlot} slot lagi. Hapus gambar lama jika ingin menambah lebih banyak.`,
                    });
                    this.value = ''; // Reset inputan
                    return;
                }

                // Munculin preview gambarnya
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

            // Update kuota kalau admin tiba-tiba nyentang/uncentang hapus gambar lama setelah pilih file
            deleteCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    // Paksa admin milih file ulang biar perhitungannya gak kacau
                    if (fileInput.files.length > 0) {
                        fileInput.value = '';
                        previewContainer.innerHTML = '';
                        Swal.fire({
                            icon: 'info',
                            title: 'Pilihan Diperbarui',
                            text: 'Anda merubah opsi gambar lama. Silakan pilih ulang gambar baru Anda.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });
            });
        </script>
    @endpush
</x-layouts.admin>