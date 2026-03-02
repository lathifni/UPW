<x-layouts.app>
    <x-slot:title>{{ $article->title }} - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            :root {
                --c-main: #84B179;
                --c-hover: #A2CB8B;
                --c-light: #C7EABB;
                --c-pale: #E8F5BD;
                --c-dark: #1a2e15;
            }

            /* HERO ARTICLE */
            .article-hero {
                background: linear-gradient(0deg, rgba(26, 46, 21, 0.95) 0%, rgba(26, 46, 21, 0.4) 100%),
                    url("{{ $article->image ? asset('storage/articles/' . $article->image) : 'https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&q=80&w=1920' }}") center/cover no-repeat;
                color: white;
                padding: 180px 0 120px 0;
                position: relative;
            }

            /* META GLASS CARD */
            .meta-glass-card {
                background: white;
                border-radius: 20px;
                padding: 1.5rem 2.5rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
                margin-top: -60px;
                position: relative;
                z-index: 10;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 1rem;
            }

            /* TYPOGRAPHY CONTENT (Substack Style) */
            .article-content-modern {
                font-size: 1.15rem;
                line-height: 1.9;
                color: #334155;
                margin-top: 2rem;
            }

            .article-content-modern p {
                margin-bottom: 1.5rem;
            }

            .article-content-modern img {
                border-radius: 16px;
                margin: 2.5rem 0;
                width: 100%;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            }

            .article-content-modern h2,
            .article-content-modern h3 {
                color: var(--c-dark);
                font-weight: 800;
                margin-top: 3rem;
                margin-bottom: 1rem;
            }

            .article-content-modern blockquote {
                border-left: 5px solid var(--c-main);
                background: var(--c-pale);
                padding: 1.5rem 2rem;
                border-radius: 0 16px 16px 0;
                font-style: italic;
                color: var(--c-dark);
                font-size: 1.25rem;
                font-weight: 600;
                margin: 2.5rem 0;
            }

            /* SHARE BUTTONS */
            .btn-share {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border: 2px solid #e2e8f0;
                color: #64748b;
                transition: all 0.3s;
                background: white;
            }

            .btn-share:hover {
                transform: translateY(-3px);
                color: white;
                border-color: transparent;
            }

            .btn-share.fb:hover {
                background: #1877F2;
            }

            .btn-share.tw:hover {
                background: #1DA1F2;
            }

            .btn-share.wa:hover {
                background: #25D366;
            }

            /* COMMENTS AREA */
            .comment-card {
                background: #f8faf7;
                border-radius: 20px;
                border: none;
                padding: 2rem;
            }

            .input-modern {
                border: 2px solid #e3e8e3;
                border-radius: 12px;
                padding: 1rem;
                transition: all 0.3s;
                background: white;
            }

            .input-modern:focus {
                border-color: var(--c-main);
                box-shadow: 0 0 0 4px rgba(132, 177, 121, 0.1);
                outline: none;
            }

            /* RELATED CARDS */
            .related-card {
                border: none;
                border-radius: 16px;
                overflow: hidden;
                transition: all 0.3s;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            }

            .related-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(132, 177, 121, 0.1);
            }
        </style>
    @endpush

    <section class="article-hero">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9" data-aos="fade-up">
                    <span class="badge bg-main text-white px-3 py-2 rounded-pill fw-bold mb-4"
                        style="background: var(--c-main);">{{ Str::title($article->category) }}</span>
                    <h1 class="display-4 fw-bolder mb-0" style="line-height: 1.2;">{{ $article->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="meta-glass-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold fs-5"
                            style="width: 50px; height: 50px; background: var(--c-dark);">
                            {{ substr($article->user->nama, 0, 1) }}
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: var(--c-dark);">{{ $article->user->nama }}</h6>
                            <small class="text-muted">{{ $article->created_at->translatedFormat('d F Y') }} • <i
                                    class="bi bi-eye ms-1"></i> {{ $article->views }} kali dibaca</small>
                        </div>
                    </div>

                    {{-- TOMBOL SHARE YANG SUDAH AKTIF --}}
                    @php
                        $shareUrl = urlencode(url()->current());
                        $shareTitle = urlencode($article->title);
                    @endphp
                    <div class="d-flex align-items-center gap-2">
                        <span class="small fw-bold text-muted me-1 d-none d-sm-inline">Bagikan:</span>

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                            rel="noopener noreferrer" class="btn-share fb">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"
                            target="_blank" rel="noopener noreferrer" class="btn-share tw">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                        <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}"
                            target="_blank" rel="noopener noreferrer" class="btn-share wa">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>

                {{-- ARTICLE CONTENT --}}
                <article class="article-content-modern py-4" data-aos="fade-in" data-aos-delay="200">
                    {!! $article->content !!}
                </article>

                {{-- TAGS / SEPARATOR --}}
                <div class="d-flex align-items-center py-4 my-4 border-top border-bottom">
                    <span class="fw-bold me-3" style="color: var(--c-dark);">Kategori:</span>
                    <a href="{{ route('articles.index.public', ['category' => $article->category]) }}"
                        class="badge bg-pale-custom text-dark text-decoration-none px-3 py-2 rounded-pill fs-6">{{ Str::title($article->category) }}</a>
                </div>

                {{-- COMMENTS SECTION --}}
                <div class="comments-section mb-5 pb-5">
                    <h4 class="fw-bolder mb-4" style="color: var(--c-dark);"><i
                            class="bi bi-chat-dots text-success me-2"></i> Komentar (0)</h4>
                    <div class="comment-card">
                        <h6 class="fw-bold mb-3">Tinggalkan Pesan</h6>
                        <form>
                            <div class="mb-3">
                                <textarea class="form-control input-modern" rows="4" placeholder="Bagikan pendapat atau dukungan Anda di sini..."></textarea>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn text-white px-4 py-2 rounded-pill fw-bold"
                                    style="background: var(--c-main);" disabled>
                                    Kirim Komentar (Segera Hadir)
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- RELATED NEWS SECTION --}}
    <section class="py-5" style="background-color: var(--c-pale);">
        <div class="container py-4">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <h2 class="fw-bolder" style="color: var(--c-dark);">Artikel Terkait</h2>
                    <p class="text-muted">Jangan lewatkan informasi menarik lainnya.</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse ($related_articles as $related)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <a href="{{ route('articles.show.public', $related->slug) }}" class="text-decoration-none">
                            <div class="card related-card h-100">
                                <img src="{{ asset('storage/articles/' . $related->image) }}" class="card-img-top"
                                    alt="{{ $related->title }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body p-4">
                                    <span
                                        class="badge bg-light text-success mb-3 px-2 py-1">{{ Str::title($related->category) }}</span>
                                    <h5 class="fw-bold text-dark mb-3" style="line-height: 1.4;">
                                        {{ Str::limit($related->title, 50) }}</h5>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>
                                            {{ $related->created_at->format('d M Y') }}</small>
                                        <span class="fw-bold text-success small">Baca <i
                                                class="bi bi-arrow-right"></i></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Tidak ada berita terkait untuk kategori ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</x-layouts.app>
