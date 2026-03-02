<x-layouts.admin>
    <x-slot:title>Edit Rekening</x-slot:title>

    @push('styles')
        <style>
            /* Styling untuk Radio Button Bank Select */
            .bank-select-card {
                cursor: pointer;
                border: 2px solid #e3e6f0;
                border-radius: 0.75rem;
                transition: all 0.2s ease-in-out;
                background-color: white;
            }

            .bank-select-card:hover {
                border-color: #b7b9cc;
                background-color: #f8f9fc;
                transform: translateY(-3px);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            }

            /* Saat bank dipilih (Checked) */
            .bank-radio:checked+.bank-select-card {
                border-color: #4e73df;
                /* Warna Primary (karena form edit tema primary) */
                background-color: #f8f9fc;
                box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
            }

            .bank-radio {
                display: none;
            }

            .bank-logo-img {
                max-height: 40px;
                object-fit: contain;
                filter: grayscale(100%);
                opacity: 0.5;
                transition: all 0.3s;
            }

            .bank-select-card:hover .bank-logo-img,
            .bank-radio:checked+.bank-select-card .bank-logo-img {
                filter: grayscale(0%);
                opacity: 1;
            }
        </style>
    @endpush

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Rekening</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('rekenings.update', $rekening->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- PILIH BANK (UI GRID) --}}
                <div class="form-group mb-4">
                    <label class="font-weight-bold">Pilih Bank <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio"
                                    value="Bank Syariah Indonesia (BSI)" data-logo="bsi.png"
                                    {{ str_contains($rekening->nama_bank, 'BSI') ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/bsi.png') }}"
                                        class="bank-logo-img img-fluid mx-auto" alt="BSI">
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio" value="Bank Mandiri"
                                    data-logo="mandiri.png"
                                    {{ str_contains($rekening->nama_bank, 'Mandiri') ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/mandiri.png') }}"
                                        class="bank-logo-img img-fluid mx-auto" alt="Mandiri">
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio"
                                    value="Bank Negara Indonesia (BNI)" data-logo="bni.png"
                                    {{ str_contains($rekening->nama_bank, 'BNI') ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/bni.png') }}"
                                        class="bank-logo-img img-fluid mx-auto" alt="BNI">
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio"
                                    value="Bank Rakyat Indonesia (BRI)" data-logo="bri.png"
                                    {{ str_contains($rekening->nama_bank, 'BRI') ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/bri.png') }}"
                                        class="bank-logo-img img-fluid mx-auto" alt="BRI">
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio"
                                    value="Bank Central Asia (BCA)" data-logo="bca.svg"
                                    {{ str_contains($rekening->nama_bank, 'BCA') ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/bca.svg') }}"
                                        class="bank-logo-img img-fluid mx-auto" alt="BCA">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Nama Bank Terisi Otomatis --}}
                <div class="form-group bg-light p-3 rounded border">
                    <label for="nama_bank" class="text-muted small font-weight-bold text-uppercase mb-1">Nama Bank
                        Terpilih</label>
                    <input type="text"
                        class="form-control border-0 bg-white font-weight-bold text-primary @error('nama_bank') is-invalid @enderror"
                        id="nama_bank" name="nama_bank" value="{{ old('nama_bank', $rekening->nama_bank) }}" readonly>

                    {{-- Hidden input file path logo lama --}}
                    @php
                        // Ekstrak nama file asli kalau sebelumnya upload manual
                        // Kalau format baru, logonya langsung bsi.png dsb
                        $defaultLogo = explode('/', $rekening->logo);
                        $defaultLogo = end($defaultLogo);
                    @endphp
                    <input type="hidden" id="logo_filename" name="logo_filename"
                        value="{{ old('logo_filename', $defaultLogo) }}">

                    @error('nama_bank')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mt-3">
                    {{-- Nomor Rekening --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_rekening" class="font-weight-bold">Nomor Rekening</label>
                            <input type="number"
                                class="form-control form-control-lg @error('nomor_rekening') is-invalid @enderror"
                                id="nomor_rekening" name="nomor_rekening"
                                value="{{ old('nomor_rekening', $rekening->nomor_rekening) }}">
                            @error('nomor_rekening')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Atas Nama --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="atas_nama" class="font-weight-bold">Atas Nama</label>
                            <input type="text"
                                class="form-control form-control-lg @error('atas_nama') is-invalid @enderror"
                                id="atas_nama" name="atas_nama" value="{{ old('atas_nama', $rekening->atas_nama) }}">
                            @error('atas_nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    {{-- Gambar QRIS --}}
                    <div class="col-md-6">
                        <div class="form-group border rounded p-3">
                            <label for="qris_image" class="font-weight-bold"><i
                                    class="fas fa-qrcode mr-2 text-primary"></i>Gambar QRIS <span
                                    class="badge badge-secondary ml-1">Opsional</span></label>

                            <div class="mb-3 text-center">
                                @if ($rekening->qris_image)
                                    <img id="preview-qris" src="{{ asset('storage/' . $rekening->qris_image) }}"
                                        alt="QRIS" class="img-fluid rounded border p-2 bg-white"
                                        style="max-height: 150px;">
                                @else
                                    <img id="preview-qris" class="img-fluid rounded border p-2 bg-white"
                                        style="max-height: 150px; display: none;">
                                @endif
                            </div>

                            <input type="file" class="form-control-file @error('qris_image') is-invalid @enderror"
                                id="qris_image" name="qris_image"
                                onchange="previewImage('qris_image', 'preview-qris')" accept="image/*">
                            <small class="form-text text-muted mt-2">Upload gambar QR Code jika ada perubahan.</small>
                            @error('qris_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Checkbox Aktif/Tidak --}}
                    <div class="col-md-6">
                        <div class="form-group border rounded p-3 h-100 d-flex flex-column justify-content-center">
                            <label class="font-weight-bold"><i class="fas fa-toggle-on mr-2 text-primary"></i>Status
                                Rekening</label>
                            <div class="custom-control custom-switch mt-2">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" class="custom-control-input" name="is_active" value="1"
                                    id="is_active" {{ old('is_active', $rekening->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" style="cursor:pointer;" for="is_active">
                                    Aktif
                                </label>
                            </div>
                            <small class="form-text text-muted mt-2">Jika dicentang, rekening ini akan muncul di
                                halaman donasi.</small>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end">
                    <a href="{{ route('rekenings.index') }}" class="btn btn-light border mr-2 px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold">Update Rekening</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script JavaScript --}}
    @push('scripts')
        <script>
            // Set awal logo kalau belum ada yang nge-klik tapi data udah ada
            document.addEventListener("DOMContentLoaded", function() {
                let checkedRadio = document.querySelector('.bank-radio:checked');
                if (checkedRadio) {
                    document.getElementById('nama_bank').value = checkedRadio.value;
                    document.getElementById('logo_filename').value = checkedRadio.dataset.logo;
                }
            });

            // JS untuk handle klik logo bank
            document.querySelectorAll('.bank-radio').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    // Update nama bank text input
                    document.getElementById('nama_bank').value = this.value;
                    // Update hidden input untuk nama file logo
                    document.getElementById('logo_filename').value = this.dataset.logo;
                });
            });

            // JS untuk handle preview gambar QRIS
            function previewImage(inputId, previewId) {
                const image = document.getElementById(inputId);
                const imgPreview = document.getElementById(previewId);

                if (image.files && image.files[0]) {
                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);

                    oFReader.onload = function(oFREvent) {
                        imgPreview.style.display = 'inline-block';
                        imgPreview.src = oFREvent.target.result;
                    }
                }
            }
        </script>
    @endpush

</x-layouts.admin>
