<x-layouts.admin>
    <x-slot:title>Edit Artikel</x-slot:title>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" />
    @endpush

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Artikel</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- ... (semua input form Anda, sama seperti di file edit sebelumnya) ... --}}
                <div class="form-group">
                    <label for="title">Judul Artikel</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $article->title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="beasiswa"
                            {{ old('category', $article->category) == 'beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                        <option value="zakat" {{ old('category', $article->category) == 'zakat' ? 'selected' : '' }}>
                            Zakat</option>
                        <option value="bencana"
                            {{ old('category', $article->category) == 'bencana' ? 'selected' : '' }}>Bencana</option>
                        <option value="pengembangan"
                            {{ old('category', $article->category) == 'pengembangan' ? 'selected' : '' }}>Pengembangan
                        </option>
                        <option value="laporan"
                            {{ old('category', $article->category) == 'laporan' ? 'selected' : '' }}>Laporan</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Isi Konten</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content-editor" name="content" rows="10">{{ old('content', $article->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    <div>
                        @if ($article->image)
                            <img src="{{ asset('storage/articles/' . $article->image) }}" alt="Gambar Artikel"
                                width="150">
                        @else
                            <p>Tidak ada gambar</p>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Ganti Gambar Utama</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                        name="image">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Artikel</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"></script>
        <script>
            $('#content-editor').trumbowyg();
        </script>
    @endpush
</x-layouts.admin>
