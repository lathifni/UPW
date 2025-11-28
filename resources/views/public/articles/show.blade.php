<x-layouts.app>
    <x-slot:title>{{ $article->title }} - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            .news-hero {
                background: linear-gradient(135deg, rgba(25, 135, 84, 0.9) 0%, rgba(32, 201, 151, 0.9) 100%), url("{{ asset('storage/articles/' . $article->image) }}") center/cover;
                color: white;
                padding: 80px 0;
            }

            .news-meta {
                background: white;
                padding: 1.5rem;
                border-radius: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                margin-top: -50px;
                position: relative;
                z-index: 10;
            }

            .news-content {
                font-size: 1.1rem;
                line-height: 1.8;
            }

            .news-content img {
                border-radius: 1rem;
                margin: 2rem 0;
            }

            .news-content blockquote {
                border-left: 4px solid #198754;
                padding-left: 1.5rem;
                margin: 2rem 0;
                font-style: italic;
                color: #6c757d;
            }

            .author-card {
                border-left: 4px solid #198754;
            }

            .related-news-card:hover {
                transform: translateY(-5px);
            }
        </style>
    @endpush

    <section class="news-hero" style="padding-top: 150px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-4">{{ $article->title }}</h1>
                    <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 text-white-50">
                        <span><i class="bi bi-calendar me-1"></i>
                            {{ $article->created_at->translatedFormat('d F Y') }}</span>
                        <span><i class="bi bi-eye me-1"></i> {{ $article->views }} views</span>
                        <span><i class="bi bi-folder me-1"></i> {{ Str::title($article->category) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news-meta-section py-0">
        <div class="container">
            <div class="news-meta">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $article->user->nama }}</h6>
                                <p class="text-muted mb-0">Penulis</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="share-buttons text-md-end">
                            <span class="text-muted me-2">Bagikan:</span>
                            <button class="btn btn-outline-primary btn-sm"><i class="bi bi-facebook"></i></button>
                            <button class="btn btn-outline-info btn-sm"><i class="bi bi-twitter"></i></button>
                            <button class="btn btn-outline-success btn-sm"><i class="bi bi-whatsapp"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news-content-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <article class="news-content">
                        {{-- Menggunakan {!! !!} agar bisa merender HTML (bold, italic, list) dari Trumbowyg --}}
                        {!! $article->content !!}
                    </article>

                    <div class="comments-section mt-5">
                        {{-- TODO: Hidupkan fitur komentar --}}
                        <h4 class="mb-4">Komentar (0)</h4>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-3">Tambah Komentar</h6>
                                <form>
                                    <div class="mb-3">
                                        <textarea class="form-control" rows="3" placeholder="Tulis komentar Anda..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3" disabled>Kirim Komentar (Segera
                                        Hadir)</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="related-news-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h3 class="section-title">Berita Terkait</h3>
                </div>
            </div>
            <div class="row g-4">
                @forelse ($related_articles as $related)
                    <div class="col-lg-4 col-md-6">
                        <div class="card related-news-card border-0 shadow-sm h-100">
                            <a href="{{ route('articles.show.public', $related->slug) }}">
                                <img src="{{ asset('storage/articles/' . $related->image) }}" class="card-img-top"
                                    alt="{{ $related->title }}" style="height: 200px; object-fit: cover;">
                            </a>
                            <div class="card-body">
                                <span class="badge bg-success mb-2">{{ Str::title($related->category) }}</span>
                                <h5 class="card-title">
                                    <a href="{{ route('articles.show.public', $related->slug) }}"
                                        class="text-decoration-none text-dark">{{ $related->title }}</a>
                                </h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted"><i class="bi bi-calendar me-1"></i>
                                        {{ $related->created_at->format('d M Y') }}</small>
                                    <a href="{{ route('articles.show.public', $related->slug) }}"
                                        class="btn btn-outline-success btn-sm">Baca</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada berita terkait.</p>
                @endforelse
            </div>
        </div>
    </section>

    @push('scripts')
        {{-- Skrip untuk tombol share --}}
    @endpush
</x-layouts.app>
