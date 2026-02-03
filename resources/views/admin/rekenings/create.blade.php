<x-layouts.admin>
    <x-slot:title>Tambah Rekening Baru</x-slot:title>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Rekening</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('rekenings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Bank --}}
                <div class="form-group">
                    <label for="nama_bank">Nama Bank</label>
                    <input type="text" class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank"
                        name="nama_bank" value="{{ old('nama_bank') }}" placeholder="Contoh: Bank Syariah Indonesia (BSI)">
                    @error('nama_bank')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Nomor Rekening --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_rekening">Nomor Rekening</label>
                            <input type="number" class="form-control @error('nomor_rekening') is-invalid @enderror"
                                id="nomor_rekening" name="nomor_rekening" value="{{ old('nomor_rekening') }}" placeholder="Contoh: 700xxxx">
                            @error('nomor_rekening')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- Atas Nama --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="atas_nama">Atas Nama</label>
                            <input type="text" class="form-control @error('atas_nama') is-invalid @enderror"
                                id="atas_nama" name="atas_nama" value="{{ old('atas_nama') }}" placeholder="Contoh: Unit Wakaf...">
                            @error('atas_nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Status Aktif --}}
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', 1) ? 'checked' : '' }}>
                    <label class="form-check-label font-weight-bold" for="is_active">
                        Aktifkan Rekening ini?
                    </label>
                    <small class="form-text text-muted">Jika dicentang, rekening akan langsung muncul di halaman Buat Program Baru.</small>
                </div>

                <hr>

                <div class="row">
                    {{-- INPUT LOGO BANK --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logo">Logo Bank</label>
                            
                            {{-- Preview Logo --}}
                            <div class="mb-2">
                                <img id="preview-logo" class="img-fluid rounded border p-1" 
                                     style="max-height: 100px; display: none;">
                            </div>

                            <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo"
                                name="logo" onchange="previewImage('logo', 'preview-logo')" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maks: 2MB</small>

                            @error('logo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- INPUT QRIS --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qris_image">Gambar QRIS (Opsional)</label>
                            
                            {{-- Preview QRIS --}}
                            <div class="mb-2">
                                <img id="preview-qris" class="img-fluid rounded border p-1" 
                                     style="max-height: 150px; display: none;">
                            </div>

                            <input type="file" class="form-control-file @error('qris_image') is-invalid @enderror" id="qris_image"
                                name="qris_image" onchange="previewImage('qris_image', 'preview-qris')" accept="image/*">
                            <small class="text-muted">Upload QR Code agar donatur bisa scan langsung.</small>

                            @error('qris_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Rekening
                    </button>
                    <a href="{{ route('rekenings.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Script JavaScript untuk Preview Gambar (Support 2 ID berbeda) --}}
    @push('scripts')
    <script>
        function previewImage(inputId, previewId) {
            const image = document.getElementById(inputId);
            const imgPreview = document.getElementById(previewId);

            if (image.files && image.files[0]) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.style.display = 'block';
                    imgPreview.src = oFREvent.target.result;
                }
            }
        }
    </script>
    @endpush

</x-layouts.admin>