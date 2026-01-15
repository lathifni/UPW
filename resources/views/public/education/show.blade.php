<x-layouts.app>
    <x-slot:title>{{ $post->title }}</x-slot:title>

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    
                    {{-- Navigasi Balik --}}
                    {{-- Pastikan route 'public.education.index' sudah ada, kalau error ganti jadi url('/edukasi') --}}
                    <a href="{{ route('public.education.index') }}" class="text-decoration-none text-muted mb-4 d-inline-block">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Edukasi
                    </a>

                    {{-- Judul Artikel --}}
                    <h1 class="fw-bold mb-3">{{ $post->title }}</h1>
                    <p class="text-muted mb-4">
                        <i class="bi bi-calendar-event me-2"></i>{{ $post->date }}
                    </p>

                    {{-- Gambar Utama --}}
                    {{-- Pastikan gambar ada di public/img/edu/ --}}
                    <img src="{{ asset('img/edu/' . $post->image) }}" class="img-fluid rounded-4 mb-5 w-100 shadow-sm" alt="{{ $post->title }}">

                    {{-- ISI KONTEN (Panggil file blade dari folder contents) --}}
                    <div class="article-content fs-5 lh-lg text-dark">
                        @include($post->view_file)
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-layouts.app>