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

                <div class="row">
                    {{-- Kategori --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select name="category" id="category"
                                class="form-control @error('category') is-invalid @enderror" onchange="checkCategory()">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Wakaf Uang" {{ old('category') == 'Wakaf Uang' ? 'selected' : '' }}>Wakaf
                                    Uang</option>
                                <option value="Wakaf Melalui Uang"
                                    {{ old('category') == 'Wakaf Melalui Uang' ? 'selected' : '' }}>Wakaf Melalui Uang
                                </option>
                                <option value="Zakat" {{ old('category') == 'Zakat' ? 'selected' : '' }}>Zakat</option>
                                <option value="Dana Abadi" {{ old('category') == 'Dana Abadi' ? 'selected' : '' }}>Dana
                                    Abadi</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- PILIHAN REKENING (PENTING) --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rekening_id">Rekening Tujuan</label>
                            <select name="rekening_id" id="rekening_id"
                                class="form-control @error('rekening_id') is-invalid @enderror">
                                <option value="">-- Pilih Rekening --</option>
                                {{-- Loop data dari Controller --}}
                                @foreach ($rekenings as $rek)
                                    <option value="{{ $rek->id }}"
                                        {{ old('rekening_id') == $rek->id ? 'selected' : '' }}>
                                        {{ $rek->nama_bank }} - {{ $rek->nomor_rekening }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Program ini akan masuk ke rekening tersebut.</small>
                            @error('rekening_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Checkbox Unggulan --}}
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_unggulan" value="1" id="is_unggulan"
                        {{ old('is_unggulan') ? 'checked' : '' }}>
                    <label class="form-check-label font-weight-bold" for="is_unggulan">
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
                            <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                                id="deadline" name="deadline" value="{{ old('deadline') }}">
                            @error('deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Gambar --}}
                <div class="form-group">
                    <label for="image">Gambar Program</label>
                    <div class="mb-3">
                        <img id="img-preview" class="img-fluid rounded border p-1"
                            style="max-height: 200px; display: none;">
                    </div>
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

    @push('scripts')
        <script>
            function previewImage() {
                const image = document.querySelector('#image');
                const imgPreview = document.querySelector('#img-preview');
                if (image.files && image.files[0]) {
                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);
                    oFReader.onload = function(oFREvent) {
                        imgPreview.style.display = 'block';
                        imgPreview.src = oFREvent.target.result;
                    }
                }
            }

            function checkCategory() {
                const category = document.getElementById('category').value;
                const targetInput = document.getElementById('target_amount');
                const deadlineInput = document.getElementById('deadline');

                // Jika Wakaf Uang atau Dana Abadi dipilih
                if (category === 'Wakaf Uang' || category === 'Dana Abadi') {
                    targetInput.value = 0;
                    targetInput.setAttribute('readonly', 'readonly');
                    // Optional: kasih background abu-abu biar keliatan disable
                    targetInput.classList.add('bg-light');

                    deadlineInput.value = '';
                    deadlineInput.setAttribute('readonly', 'readonly');
                    deadlineInput.classList.add('bg-light');
                } else {
                    // Kembalikan ke normal
                    targetInput.removeAttribute('readonly');
                    targetInput.classList.remove('bg-light');

                    deadlineInput.removeAttribute('readonly');
                    deadlineInput.classList.remove('bg-light');
                }
            }

            // Panggil fungsi sekali saat halaman dimuat (untuk handle error validation kembali)
            document.addEventListener('DOMContentLoaded', checkCategory);
        </script>
    @endpush
</x-layouts.admin>
