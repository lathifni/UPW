<x-layouts.admin>
    <x-slot:title>Edit Program</x-slot:title>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Program</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                {{-- Judul --}}
                <div class="form-group">
                    <label for="title">Judul Program</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $program->title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="5">{{ old('description', $program->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Kategori (Sesuai Create) --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                {{-- Kita pakai array manual biar rapi --}}
                                @php
                                    $categories = ['Wakaf Uang', 'Wakaf Melalui Uang', 'Zakat', 'Dana Abadi'];
                                @endphp

                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $program->category) == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- PILIHAN REKENING (Ditambahkan) --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rekening_id">Rekening Tujuan</label>
                            <select name="rekening_id" id="rekening_id" class="form-control @error('rekening_id') is-invalid @enderror">
                                <option value="">-- Pilih Rekening --</option>
                                @foreach($rekenings as $rek)
                                    <option value="{{ $rek->id }}" {{ old('rekening_id', $program->rekening_id) == $rek->id ? 'selected' : '' }}>
                                        {{ $rek->nama_bank }} - {{ $rek->nomor_rekening }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Rekening tujuan donasi untuk program ini.</small>
                            @error('rekening_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Checkbox Unggulan --}}
                <div class="form-check mb-3">
                    {{-- Hidden input agar kalau unchecked tetap kirim value 0 --}}
                    <input type="hidden" name="is_unggulan" value="0">
                    <input class="form-check-input" type="checkbox" name="is_unggulan" value="1" id="is_unggulan" 
                        {{ old('is_unggulan', $program->is_unggulan) ? 'checked' : '' }}>
                    <label class="form-check-label font-weight-bold" for="is_unggulan">
                        Jadikan Program Unggulan?
                    </label>
                </div>

                {{-- Jenis Sertifikat --}}
                <div class="form-group mb-3">
                    <label for="certificate_type" class="form-label">Jenis Sertifikat</label>
                    <select class="form-control" id="certificate_type" name="certificate_type">
                        <option value="none" {{ old('certificate_type', $program->certificate_type) == 'none' ? 'selected' : '' }}>Tidak Ada (Default)</option>
                        <option value="sertifikat_standar" {{ old('certificate_type', $program->certificate_type) == 'sertifikat_standar' ? 'selected' : '' }}>Sertifikat Standar (Dinamis)</option>
                        <option value="akta_wakaf" {{ old('certificate_type', $program->certificate_type) == 'akta_wakaf' ? 'selected' : '' }}>Akta Ikrar Wakaf (Fixed)</option>
                        <option value="surat_apresiasi" {{ old('certificate_type', $program->certificate_type) == 'surat_apresiasi' ? 'selected' : '' }}>Surat Apresiasi Rektor (Fixed)</option>
                    </select>
                </div>

                {{-- Target & Deadline --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="target_amount">Target Dana</label>
                            <input type="number" class="form-control @error('target_amount') is-invalid @enderror"
                                id="target_amount" name="target_amount" value="{{ old('target_amount', $program->target_amount) }}">
                            @error('target_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="deadline">Batas Waktu (Opsional)</label>
                            <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline"
                                name="deadline" value="{{ old('deadline', $program->deadline) }}">
                            @error('deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- GAMBAR PROGRAM (Layout Baru) --}}
                <div class="form-group">
                    <label>Gambar Program</label>
                    
                    <div class="row">
                        {{-- Gambar Lama --}}
                        <div class="col-md-4 mb-2">
                            <p class="small text-muted mb-1 font-weight-bold">Gambar Saat Ini:</p>
                            @if($program->image)
                                <img src="{{ asset('storage/programs/' . $program->image) }}" class="img-fluid rounded border" style="max-height: 150px;" alt="Current Image">
                            @else
                                <div class="border rounded p-3 text-center bg-light text-muted">Belum ada gambar</div>
                            @endif
                        </div>

                        {{-- Preview Gambar Baru --}}
                        <div class="col-md-4 mb-2">
                            <p class="small text-muted mb-1 font-weight-bold">Preview Gambar Baru:</p>
                            <img id="img-preview" class="img-fluid rounded border p-1" style="max-height: 150px; display: none;">
                            <p id="no-preview" class="small text-muted font-italic">Belum ada gambar baru dipilih.</p>
                        </div>
                    </div>

                    <label for="image" class="mt-2">Ganti Gambar (Opsional)</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                        name="image" onchange="previewImage()">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Update Program
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
            const noPreviewText = document.querySelector('#no-preview');

            if (image.files && image.files[0]) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.style.display = 'block';
                    imgPreview.src = oFREvent.target.result;
                    if(noPreviewText) noPreviewText.style.display = 'none';
                }
            }
        }
    </script>
    @endpush

</x-layouts.admin>