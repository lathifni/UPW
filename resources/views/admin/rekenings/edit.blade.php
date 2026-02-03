<x-layouts.admin>
    <x-slot:title>Edit Rekening</x-slot:title>

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Rekening</h6>
        </div>
        <div class="card-body">
            {{-- Pastikan route-nya sesuai dengan resource controller (rekenings.update) --}}
            <form action="{{ route('rekenings.update', $rekening->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- 1. Nama Bank --}}
                <div class="form-group">
                    <label for="nama_bank">Nama Bank</label>
                    <input type="text" class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank"
                        name="nama_bank" value="{{ old('nama_bank', $rekening->nama_bank) }}" placeholder="Contoh: Bank Syariah Indonesia (BSI)">
                    @error('nama_bank')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 2. Nomor Rekening --}}
                <div class="form-group">
                    <label for="nomor_rekening">Nomor Rekening</label>
                    <input type="number" class="form-control @error('nomor_rekening') is-invalid @enderror" id="nomor_rekening"
                        name="nomor_rekening" value="{{ old('nomor_rekening', $rekening->nomor_rekening) }}">
                    @error('nomor_rekening')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 3. Atas Nama --}}
                <div class="form-group">
                    <label for="atas_nama">Atas Nama</label>
                    <input type="text" class="form-control @error('atas_nama') is-invalid @enderror" id="atas_nama"
                        name="atas_nama" value="{{ old('atas_nama', $rekening->atas_nama) }}">
                    @error('atas_nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 4. Checkbox Aktif/Tidak --}}
                <div class="form-check mb-4">
                    {{-- Hidden input untuk menangani uncheck value (opsional tapi disarankan) --}}
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                        {{ old('is_active', $rekening->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label font-weight-bold" for="is_active">
                        Status Aktif
                    </label>
                    <small class="form-text text-muted">Jika dicentang, rekening ini akan muncul di halaman donasi.</small>
                </div>

                <hr>

                {{-- 5. Logo Bank --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Logo Bank Saat Ini</label>
                            <div class="mb-2">
                                @if ($rekening->logo)
                                    {{-- Pastikan path storage sesuai dengan controller --}}
                                    <img src="{{ asset('storage/rekenings/' . $rekening->logo) }}" alt="Logo Bank"
                                        class="img-thumbnail" style="height: 80px;">
                                @else
                                    <p class="text-muted font-italic">Tidak ada logo</p>
                                @endif
                            </div>
                            <label for="logo">Ganti Logo Bank</label>
                            <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo"
                                name="logo" accept="image/*">
                            <small class="form-text text-muted">Format: jpg, png, jpeg. Kosongkan jika tidak ingin mengubah.</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- 6. Gambar QRIS --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>QRIS Saat Ini</label>
                            <div class="mb-2">
                                @if ($rekening->qris_image)
                                    <img src="{{ asset('storage/rekenings/' . $rekening->qris_image) }}" alt="QRIS"
                                        class="img-thumbnail" style="height: 150px;">
                                @else
                                    <p class="text-muted font-italic">Tidak ada gambar QRIS</p>
                                @endif
                            </div>
                            <label for="qris_image">Ganti Gambar QRIS</label>
                            <input type="file" class="form-control-file @error('qris_image') is-invalid @enderror" id="qris_image"
                                name="qris_image" accept="image/*">
                            <small class="form-text text-muted">Upload gambar QR Code jika ada.</small>
                            @error('qris_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <button type="submit" class="btn btn-primary">Update Rekening</button>
                <a href="{{ route('rekenings.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-layouts.admin>