<x-layouts.admin>
    <x-slot:title>Tambah Rekening Baru</x-slot:title>

    @push('styles')
    <style>
        /* Styling untuk Radio Button Bank Select (Tema Biru/Primary) */
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
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        /* Saat bank dipilih (Checked) - Pakai Warna Primary Biru */
        .bank-radio:checked + .bank-select-card {
            border-color: #4e73df;
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
        .bank-radio:checked + .bank-select-card .bank-logo-img {
            filter: grayscale(0%);
            opacity: 1;
        }
    </style>
    @endpush

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Rekening</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('rekenings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- PILIH BANK (UI GRID) --}}
                <div class="form-group mb-4">
                    <label class="font-weight-bold">Pilih Bank <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio" value="Bank Syariah Indonesia (BSI)" data-logo="bsi.png" {{ old('logo_filename') == 'bsi.png' ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/bsi.png') }}" class="bank-logo-img img-fluid mx-auto" alt="BSI">
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio" value="Bank Mandiri" data-logo="mandiri.png" {{ old('logo_filename') == 'mandiri.png' ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/mandiri.png') }}" class="bank-logo-img img-fluid mx-auto" alt="Mandiri">
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio" value="Bank Negara Indonesia (BNI)" data-logo="bni.png" {{ old('logo_filename') == 'bni.png' ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/bni.png') }}" class="bank-logo-img img-fluid mx-auto" alt="BNI">
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio" value="Bank Rakyat Indonesia (BRI)" data-logo="bri.png" {{ old('logo_filename') == 'bri.png' ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/bri.png') }}" class="bank-logo-img img-fluid mx-auto" alt="BRI">
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0">
                                <input type="radio" name="bank_selector" class="bank-radio" value="Bank Central Asia (BCA)" data-logo="bca.svg" {{ old('logo_filename') == 'bca.svg' ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center">
                                    <img src="{{ asset('images/bank/bca.svg') }}" class="bank-logo-img img-fluid mx-auto" alt="BCA">
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-4 col-lg-2 mb-3">
                            <label class="w-100 mb-0 h-100">
                                <input type="radio" name="bank_selector" class="bank-radio" value="manual" data-logo="default.png" {{ old('bank_selector') == 'manual' ? 'checked' : '' }}>
                                <div class="card bank-select-card h-100 py-3 px-2 text-center d-flex align-items-center justify-content-center" style="min-height: 74px;">
                                    <div class="bank-logo-img d-flex flex-column align-items-center justify-content-center w-100 text-secondary">
                                        <i class="fas fa-keyboard mb-1" style="font-size: 1.2rem;"></i>
                                        <span class="small font-weight-bold">Bank Lainnya</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Nama Bank Terisi Otomatis --}}
                <div class="form-group bg-light p-3 rounded border" id="container_nama_bank">
                    <label for="nama_bank" class="text-muted small font-weight-bold text-uppercase mb-1" id="label_nama_bank">Nama Bank Terpilih</label>
                    <input type="text" class="form-control border-0 bg-white font-weight-bold text-primary @error('nama_bank') is-invalid @enderror"
                        id="nama_bank" name="nama_bank" value="{{ old('nama_bank') }}" readonly placeholder="Silakan klik logo bank di atas...">

                    {{-- Input hidden untuk mengirim nama file logo ke controller --}}
                    <input type="hidden" id="logo_filename" name="logo_filename" value="{{ old('logo_filename', 'default.png') }}">

                    @error('nama_bank')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mt-3">
                    {{-- Nomor Rekening --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_rekening" class="font-weight-bold">Nomor Rekening <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-lg @error('nomor_rekening') is-invalid @enderror" id="nomor_rekening"
                                name="nomor_rekening" value="{{ old('nomor_rekening') }}" placeholder="Contoh: 700xxxx" required>
                            @error('nomor_rekening')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Atas Nama --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="atas_nama" class="font-weight-bold">Atas Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('atas_nama') is-invalid @enderror" id="atas_nama"
                                name="atas_nama" value="{{ old('atas_nama') }}" placeholder="Contoh: UPW UNAND" required>
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
                            <label for="qris_image" class="font-weight-bold"><i class="fas fa-qrcode mr-2 text-primary"></i>Gambar QRIS <span class="badge badge-secondary ml-1">Opsional</span></label>

                            <div class="mb-3 text-center">
                                <img id="preview-qris" class="img-fluid rounded border p-2 bg-white"
                                     style="max-height: 150px; display: none;">
                            </div>

                            <input type="file" class="form-control-file @error('qris_image') is-invalid @enderror" id="qris_image"
                                name="qris_image" onchange="previewImage('qris_image', 'preview-qris')" accept="image/*">
                            <small class="form-text text-muted mt-2">Upload barcode QRIS jika ada (Format: JPG, PNG. Maks: 2MB).</small>
                            @error('qris_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Checkbox Aktif/Tidak --}}
                    <div class="col-md-6">
                        <div class="form-group border rounded p-3 h-100 d-flex flex-column justify-content-center">
                            <label class="font-weight-bold"><i class="fas fa-toggle-on mr-2 text-primary"></i>Status Rekening</label>
                            <div class="custom-control custom-switch mt-2">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" class="custom-control-input" name="is_active" value="1" id="is_active"
                                    {{ old('is_active', 1) ? 'checked' : '' }}>
                                <label class="custom-control-label" style="cursor:pointer;" for="is_active">
                                    Aktifkan Rekening Ini
                                </label>
                            </div>
                            <small class="form-text text-muted mt-2">Jika dicentang, rekening ini akan langsung muncul di halaman donasi publik.</small>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end">
                    <a href="{{ route('rekenings.index') }}" class="btn btn-light border mr-2 px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold">Simpan Rekening</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script JavaScript --}}
    @push('scripts')
    <script>
        // Fungsi untuk mengatur tampilan input Nama Bank
        function toggleManualInput(isManual, bankName = '', logoName = 'default.png') {
            const inputNamaBank = document.getElementById('nama_bank');
            const labelNamaBank = document.getElementById('label_nama_bank');
            const containerNamaBank = document.getElementById('container_nama_bank');
            const hiddenLogo = document.getElementById('logo_filename');

            if (isManual) {
                // Mode Ketik Manual
                inputNamaBank.readOnly = false;
                inputNamaBank.value = bankName === 'manual' ? '' : bankName; // Kosongkan jika baru diklik
                inputNamaBank.placeholder = "Ketik nama bank di sini (contoh: Bank Nagari)...";
                inputNamaBank.classList.add('input-manual-active');
                
                labelNamaBank.innerHTML = 'Ketik Nama Bank <span class="text-danger">*</span>';
                labelNamaBank.classList.add('text-primary');
                
                hiddenLogo.value = 'default.png'; // Set logo default kalau bank manual
                
                inputNamaBank.focus();
            } else {
                // Mode Otomatis dari Logo
                inputNamaBank.readOnly = true;
                inputNamaBank.value = bankName;
                inputNamaBank.classList.remove('input-manual-active');
                
                labelNamaBank.innerHTML = 'Nama Bank Terpilih';
                labelNamaBank.classList.remove('text-primary');
                
                hiddenLogo.value = logoName;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Cek kondisi awal saat halaman load (berguna pas kena validasi error/old input)
            let checkedRadio = document.querySelector('.bank-radio:checked');
            let oldNamaBank = "{{ old('nama_bank') }}";
            
            if(checkedRadio) {
                if(checkedRadio.value === 'manual') {
                    toggleManualInput(true, oldNamaBank);
                } else {
                    toggleManualInput(false, checkedRadio.value, checkedRadio.dataset.logo);
                }
            }
        });

        // Event listener pas radio button diklik
        document.querySelectorAll('.bank-radio').forEach(function(radio) {
            radio.addEventListener('change', function() {
                if(this.value === 'manual') {
                    toggleManualInput(true);
                } else {
                    toggleManualInput(false, this.value, this.dataset.logo);
                }
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
