<x-layouts.admin>
    <x-slot:title>Tambah Artikel Baru</x-slot:title>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" />
    @endpush

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Artikel</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- ... (semua input form Anda: title, category, dll) ... --}}
                <div class="form-group">
                    <label for="title">Judul Artikel</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="beasiswa">Beasiswa</option>
                        <option value="zakat">Zakat</option>
                        <option value="bencana">Bencana</option>
                        <option value="pengembangan">Pengembangan</option>
                        <option value="laporan">Laporan</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content-editor">Isi Konten</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content-editor" name="content" rows="10">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Gambar Utama</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                        name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan Artikel</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"></script>
        <script>
            // Inisialisasi Trumbowyg
            $('#content-editor').trumbowyg();
        </script>
    @endpush
</x-layouts.admin>
