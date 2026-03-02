<x-layouts.app>
    <x-slot:title>Berita & Kegiatan - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            :root {
                --c-main: #84B179;
                --c-hover: #A2CB8B;
                --c-light: #C7EABB;
                --c-pale: #E8F5BD;
                --c-dark: #1a2e15;
            }

            body {
                background-color: #f8faf7;
            }

            /* HERO SECTION */
            .news-hero {
                background: linear-gradient(135deg, rgba(26, 46, 21, 0.9) 0%, rgba(132, 177, 121, 0.85) 100%),
                    url("https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&q=80&w=1920") center/cover no-repeat;
                color: white;
                padding: 160px 0 100px 0;
                position: relative;
            }

            .hero-pattern {
                position: absolute;
                inset: 0;
                opacity: 0.1;
                background-image: radial-gradient(#fff 1px, transparent 1px);
                background-size: 20px 20px;
            }

            /* STATS GLASS */
            .stat-glass {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 20px;
                padding: 1.2rem;
                transition: transform 0.3s;
            }

            .stat-glass:hover {
                transform: translateY(-5px);
                background: rgba(255, 255, 255, 0.15);
            }

            /* FILTER & SEARCH */
            .filter-modern-card {
                background: white;
                border-radius: 24px;
                padding: 1.5rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
                position: relative;
                z-index: 10;
                margin-top: -40px;
            }

            .btn-filter {
                border: 2px solid var(--c-pale);
                background: white;
                color: var(--c-dark);
                padding: 0.5rem 1.5rem;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s;
                margin: 0.25rem;
                display: inline-block;
            }

            .btn-filter:hover,
            .btn-filter.active {
                background: var(--c-main);
                border-color: var(--c-main);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(132, 177, 121, 0.3);
            }

            .search-pill {
                background: #f8faf7;
                border-radius: 50px;
                padding: 5px 20px;
                display: flex;
                align-items: center;
                border: 2px solid transparent;
                transition: all 0.3s;
            }

            .search-pill:focus-within {
                border-color: var(--c-main);
                background: white;
            }

            .search-input {
                border: none;
                background: transparent;
                box-shadow: none !important;
            }

            /* NEWS CARD MODERN */
            .news-card-modern {
                background: white;
                border-radius: 20px;
                overflow: hidden;
                border: none;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
                transition: all 0.4s ease;
                display: flex;
                flex-direction: column;
                height: 100%;
                position: relative;
                z-index: 1;
                /* Ciptakan stacking context */
            }

            .news-card-modern:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(132, 177, 121, 0.15);
            }

            .news-img-wrap {
                height: 220px;
                overflow: hidden;
                position: relative;
            }

            .news-img-wrap img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.7s ease;
            }

            .news-card-modern:hover .news-img-wrap img {
                transform: scale(1.08);
            }

            .news-badge {
                position: absolute;
                bottom: 15px;
                left: 20px;
                background: var(--c-main);
                color: white;
                padding: 5px 15px;
                border-radius: 50px;
                font-size: 0.8rem;
                font-weight: 700;
                z-index: 10;
                /* Naikkan z-index secara signifikan agar di atas segalanya */
                box-shadow: 0 4px 10px rgba(132, 177, 121, 0.4);
                border: 3px solid white;
            }

            .news-content {
                padding: 2.5rem 1.5rem 1.5rem;
                display: flex;
                flex-direction: column;
                flex-grow: 1;
            }

            .news-title {
                font-weight: 800;
                font-size: 1.2rem;
                color: var(--c-dark);
                line-height: 1.4;
                margin-bottom: 1rem;
                transition: color 0.3s;
            }

            .news-card-modern:hover .news-title {
                color: var(--c-main);
            }

            /* SIDEBAR MODERN */
            .sidebar-modern {
                background: white;
                border-radius: 24px;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
                margin-bottom: 2rem;
            }

            .sidebar-title {
                font-weight: 800;
                color: var(--c-dark);
                margin-bottom: 1.5rem;
                position: relative;
                padding-bottom: 0.5rem;
            }

            .sidebar-title::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 40px;
                height: 4px;
                background: var(--c-main);
                border-radius: 10px;
            }

            .cat-item {
                display: flex;
                justify-content: space-between;
                padding: 0.8rem 0;
                border-bottom: 1px dashed rgba(0, 0, 0, 0.05);
                color: #555;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.2s;
            }

            .cat-item:hover {
                color: var(--c-main);
                transform: translateX(5px);
            }

            .cat-item:last-child {
                border-bottom: none;
            }

            .recent-news-item {
                display: flex;
                gap: 15px;
                align-items: center;
                padding: 1rem 0;
                border-bottom: 1px dashed rgba(0, 0, 0, 0.05);
                text-decoration: none;
            }

            .recent-news-item:hover .recent-title {
                color: var(--c-main);
            }

            .recent-title {
                font-weight: 700;
                color: var(--c-dark);
                font-size: 0.95rem;
                line-height: 1.4;
                transition: color 0.2s;
                margin-bottom: 0.2rem;
            }
        </style>
    @endpush

    <section class="news-hero">
        <div class="hero-pattern"></div>
        <div class="container position-relative z-index-1">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start" data-aos="fade-right">
                    <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">Pusat
                        Informasi</span>
                    <h1 class="display-4 fw-bolder mb-3">Kabar Berita & Inspirasi</h1>
                    <p class="fs-5 text-white-50 mb-0" style="line-height: 1.6;">
                        Ikuti perkembangan terbaru, cerita inspiratif, dan transparansi penyaluran program Dana Sosial
                        UNAND.
                    </p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="row g-3 justify-content-center justify-content-lg-end">
                        <div class="col-5 col-md-4">
                            <div class="stat-glass text-center">
                                <h3 class="fw-bolder mb-0 text-white">{{ $stats['total_articles'] }}</h3>
                                <small class="text-white-50 text-uppercase fw-bold ls-1"
                                    style="font-size: 0.7rem;">Artikel</small>
                            </div>
                        </div>
                        <div class="col-5 col-md-4">
                            <div class="stat-glass text-center">
                                <h3 class="fw-bolder mb-0 text-white">{{ format_large_number($stats['total_views']) }}
                                </h3>
                                <small class="text-white-50 text-uppercase fw-bold ls-1"
                                    style="font-size: 0.7rem;">Pembaca</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <div class="container">
        <div class="filter-modern-card" data-aos="zoom-in" data-aos-delay="100">
            <div class="row align-items-center g-3">

                {{-- KIRI: FILTER KATEGORI --}}
                <div class="col-lg-8">
                    <div class="d-flex flex-wrap align-items-center gap-1">
                        <span class="text-muted small fw-bold me-2 d-none d-md-inline">Filter:</span>

                        {{-- Tambah class text-decoration-none biar garis bawahnya hilang --}}
                        <a href="{{ route('articles.index.public') }}"
                            class="btn-filter text-decoration-none {{ !request('category') ? 'active' : '' }}">
                            Semua
                        </a>

                        @foreach ($categories as $category)
                            <a href="{{ route('articles.index.public', ['category' => $category]) }}"
                                class="btn-filter text-decoration-none {{ request('category') == $category ? 'active' : '' }}">
                                {{ Str::title($category) }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- KANAN: SEARCH BOX --}}
                <div class="col-lg-4">
                    <form action="{{ route('articles.index.public') }}" method="GET">
                        {{-- Tambahin d-flex dan padding penyesuaian biar tombolnya masuk ke dalam pill --}}
                        <div class="search-pill d-flex align-items-center" style="padding: 4px 6px 4px 15px; border-radius: 50px; background: #f8faf7; border: 2px solid transparent; transition: all 0.3s;">
                            <i class="bi bi-search text-muted"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control search-input flex-grow-1 border-0 shadow-none bg-transparent"
                                placeholder="Cari artikel..." style="box-shadow: none !important; outline: none;">

                            {{-- Tombol Cari ditambahkan di sini --}}
                            <button type="submit" class="btn btn-success rounded-pill btn-sm px-4 fw-bold" style="background-color: var(--c-main); border: none;">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <section class="py-5 mt-4">
        <div class="container">
            <div class="row g-5">
                {{-- KIRI: List Artikel (8 Kolom) --}}
                <div class="col-lg-8">
                    <div class="row g-4">
                        @forelse ($articles as $article)
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 2) * 100 }}">
                                <a href="{{ route('articles.show.public', $article->slug) }}"
                                    class="text-decoration-none">
                                    <div class="news-card-modern">
                                        <div class="news-img-wrap">
                                            @if ($article->image)
                                                <img src="{{ asset('storage/articles/' . $article->image) }}"
                                                    alt="{{ $article->title }}">
                                            @else
                                                <img
                                                    src="https://images.unsplash.com/photo-1585828068979-24653dbd591c?auto=format&fit=crop&q=80&w=600">
                                            @endif
                                            <span class="news-badge">{{ Str::title($article->category) }}</span>
                                        </div>
                                        <div class="news-content">
                                            <div class="text-muted small fw-bold mb-2 d-flex align-items-center">
                                                <i class="bi bi-calendar3 me-2 text-success"></i>
                                                {{ $article->created_at->format('d M Y') }}
                                            </div>
                                            <h3 class="news-title">{{ Str::limit($article->title, 55) }}</h3>
                                            <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
                                                {{ Str::limit(strip_tags($article->content), 100) }}
                                            </p>
                                            <div
                                                class="mt-auto border-top pt-3 d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-success small">Baca Selengkapnya</span>
                                                <i class="bi bi-arrow-right text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="d-inline-block p-4 rounded-circle mb-3" style="background: var(--c-pale);">
                                    <i class="bi bi-newspaper text-success display-4"></i>
                                </div>
                                <h4 class="fw-bold" style="color: var(--c-dark);">Belum Ada Berita</h4>
                                <p class="text-muted">Kategori atau pencarian ini belum memiliki artikel.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-5 d-flex justify-content-center">
                        {{ $articles->links() }}
                    </div>
                </div>

                {{-- KANAN: Sidebar (4 Kolom) --}}
                <div class="col-lg-4">
                    {{-- Kategori --}}
                    <div class="sidebar-modern" data-aos="fade-left" data-aos-delay="100">
                        <h4 class="sidebar-title">Kategori</h4>
                        <div>
                            @foreach ($category_counts as $category => $count)
                                <a href="{{ route('articles.index.public', ['category' => $category]) }}"
                                    class="cat-item">
                                    <span><i class="bi bi-folder2 me-2"></i> {{ Str::title($category) }}</span>
                                    <span
                                        class="badge bg-pale-custom text-dark rounded-pill align-self-center">{{ $count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Berita Terbaru (Minimalist List) --}}
                    <div class="sidebar-modern" data-aos="fade-left" data-aos-delay="200">
                        <h4 class="sidebar-title">Terbaru</h4>
                        <div>
                            @forelse ($recent_articles as $recent)
                                <a href="{{ route('articles.show.public', $recent->slug) }}" class="recent-news-item">
                                    <div class="flex-shrink-0 rounded-3 overflow-hidden"
                                        style="width: 70px; height: 70px;">
                                        @if ($recent->image)
                                            <img src="{{ asset('storage/articles/' . $recent->image) }}"
                                                class="w-100 h-100 object-fit-cover">
                                        @else
                                            <div
                                                class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="recent-title">{{ Str::limit($recent->title, 40) }}</h5>
                                        <small class="text-muted" style="font-size: 0.75rem;"><i
                                                class="bi bi-clock me-1"></i>
                                            {{ $recent->created_at?->diffForHumans(null, true) }} yang lalu</small>
                                    </div>
                                </a>
                            @empty
                                <p class="text-muted small mb-0">Belum ada berita.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layouts.app>
