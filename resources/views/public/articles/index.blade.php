<x-layouts.app>
    <x-slot:title>Berita & Kegiatan - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            .news-hero {
                background: linear-gradient(135deg,
                        rgba(25, 135, 84, 0.9) 0%,
                        rgba(32, 201, 151, 0.9) 100%),
                    url("https://via.placeholder.com/1920x600/198754/ffffff?text=Berita+%26+Kegiatan") center/cover;
                color: white;
                padding: 100px 0;
            }

            .news-filter {
                background: white;
                padding: 2rem;
                border-radius: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                margin-top: -50px;
                position: relative;
                z-index: 10;
            }

            .filter-btn {
                border: 2px solid #e9ecef;
                background: white;
                color: #6c757d;
                padding: 0.5rem 1.5rem;
                border-radius: 2rem;
                margin: 0.25rem;
                transition: all 0.3s ease;
                text-decoration: none;
            }

            .filter-btn:hover,
            .filter-btn.active {
                background: #198754;
                border-color: #198754;
                color: white;
                text-decoration: none;
            }

            .news-card {
                background: white;
                border-radius: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                border: 1px solid #e9ecef;
                overflow: hidden;
                height: 100%;
            }

            .news-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }

            .news-image {
                position: relative;
                overflow: hidden;
            }

            .news-image img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                transition: all 0.3s ease;
            }

            .news-card:hover .news-image img {
                transform: scale(1.05);
            }

            .news-badge {
                position: absolute;
                top: 1rem;
                right: 1rem;
                z-index: 2;
            }

            .news-content {
                padding: 1.5rem;
            }

            .news-meta {
                color: #6c757d;
                font-size: 0.875rem;
                margin-bottom: 0.75rem;
            }

            .news-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--neutral-darker);
                margin-bottom: 0.75rem;
                line-height: 1.4;
            }

            .news-excerpt {
                color: #6c757d;
                line-height: 1.6;
                margin-bottom: 1rem;
            }

            .news-footer {
                border-top: 1px solid #e9ecef;
                padding-top: 1rem;
                display: flex;
                justify-content: between;
                align-items: center;
            }

            .featured-news {
                margin-bottom: 3rem;
            }

            .featured-card {
                border: 2px solid #198754;
                transform: scale(1.02);
            }

            .sidebar-card {
                background: white;
                border-radius: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 1px solid #e9ecef;
                margin-bottom: 2rem;
            }

            .sidebar-header {
                background: #198754;
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 1rem 1rem 0 0;
            }

            .list-group-item {
                border: none;
                border-bottom: 1px solid #e9ecef;
                padding: 1rem 1.5rem;
            }

            .list-group-item:last-child {
                border-bottom: none;
            }

            .newsletter-form .form-control {
                border: 1px solid #198754;
            }

            .pagination .page-link {
                color: #198754;
                border: 1px solid #dee2e6;
            }

            .pagination .page-item.active .page-link {
                background: #198754;
                border-color: #198754;
                color: white;
            }

            .search-box {
                position: relative;
            }

            .search-box input {
                padding-right: 3rem;
            }

            .search-box .search-icon {
                position: absolute;
                right: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: #6c757d;
            }
        </style>
    @endpush

    <section class="news-hero" style="padding-top: 150px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Berita & Kegiatan</h1>
                    <p class="lead mb-4">Update terbaru seputar kegiatan, perkembangan program, dan pencapaian Dana
                        Sosial UNAND</p>
                    <div class="hero-stats">
                        <div class="row justify-content-center">
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">{{ $stats['total_articles'] }}</h3>
                                    <p class="stat-label text-white-50">Artikel</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">{{ $stats['total_categories'] }}</h3>
                                    <p class="stat-label text-white-50">Kategori</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">{{ format_large_number($stats['total_views']) }}
                                    </h3>
                                    <p class="stat-label text-white-50">Pembaca</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news-filter-section py-0">
        <div class="container">
            <div class="news-filter">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h5 class="mb-3">Filter Berita:</h5>
                        <div class="filter-buttons">
                            <a href="{{ route('articles.index.public') }}"
                                class="filter-btn {{ !request('category') ? 'active' : '' }}">
                                Semua Berita
                            </a>
                            @foreach ($categories as $category)
                                <a href="{{ route('articles.index.public', ['category' => $category]) }}"
                                    class="filter-btn {{ request('category') == $category ? 'active' : '' }}">
                                    {{ Str::title($category) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="search-box">
                            <input type="text" class="form-control" placeholder="Cari berita..." />
                            <i class="bi bi-search search-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row g-4">
                        @forelse ($articles as $article)
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 2) * 100 }}">
                                <div class="news-card">
                                    <div class="news-image">
                                        <a href="{{ route('articles.show.public', $article->slug) }}">
                                            <img src="{{ asset('storage/articles/' . $article->image) }}"
                                                alt="{{ $article->title }}" />
                                        </a>
                                        <span
                                            class="news-badge badge bg-success">{{ Str::title($article->category) }}</span>
                                    </div>
                                    <div class="news-content">
                                        <div class="news-meta">
                                            <i class="bi bi-calendar me-1"></i>
                                            {{ $article->created_at->format('d F Y') }}
                                        </div>
                                        <h5 class="news-title">
                                            <a href="{{ route('articles.show.public', $article->slug) }}"
                                                class="text-decoration-none text-dark">{{ $article->title }}</a>
                                        </h5>
                                        <p class="news-excerpt">{{ Str::limit(strip_tags($article->content), 100) }}
                                        </p>
                                        <div class="news-footer">
                                            <a href="{{ route('articles.show.public', $article->slug) }}"
                                                class="btn btn-outline-success btn-sm">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">Belum ada berita yang dipublikasikan.</div>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-5">
                        {{ $articles->links() }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-card">
                        <div class="sidebar-header">
                            <h5 class="mb-0"><i class="bi bi-bookmarks me-2"></i>Kategori Berita</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach ($category_counts as $category => $count)
                                <a href="{{ route('articles.index.public', ['category' => $category]) }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ Str::title($category) }}
                                    <span class="badge bg-success rounded-pill">{{ $count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <div class="sidebar-header">
                            <h5 class="mb-0"><i class="bi bi-clock me-2"></i>Berita Terbaru</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            @forelse ($recent_articles as $recent)
                                <a href="{{ route('articles.show.public', $recent->slug) }}"
                                    class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ Str::limit($recent->title, 35) }}</h6>
                                        <small
                                            class="text-muted">{{ $recent->created_at->diffForHumans(null, true) }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small">{{ Str::limit(strip_tags($recent->content), 50) }}
                                    </p>
                                </a>
                            @empty
                                <div class="list-group-item">
                                    <p class="text-muted mb-0">Belum ada berita terbaru.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="sidebar-card mb-4">
                        <div class="sidebar-header">
                            <h5 class="mb-0"><i class="bi bi-bar-chart-line me-2"></i>Statistik</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <div class="stats-card p-3">
                                        <h4 class="text-success mb-1">{{ $stats['total_articles'] }}</h4>
                                        <small class="text-muted">Total Berita</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="stats-card p-3">
                                        <h4 class="text-success mb-1">{{ number_format($stats['total_views']) }}</h4>
                                        <small class="text-muted">Total Views</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stats-card p-3">
                                        <h4 class="text-success mb-1">{{ $stats['total_categories'] }}</h4>
                                        <small class="text-muted">Kategori</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stats-card p-3">
                                        <h4 class="text-success mb-1">{{ $stats['total_authors'] }}</h4>
                                        <small class="text-muted">Penulis</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
