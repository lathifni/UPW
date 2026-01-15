<article class="max-w-4xl mx-auto px-4 py-10">

    <!-- <h1 class="text-3xl font-bold mb-4">
        {{ $post->title }}
    </h1>

    <p class="text-sm text-gray-500 mb-6">
        {{ $post->date }}
        @if($post->penulis)
            · {{ $post->penulis }}
        @endif
    </p>

    <img 
      src="{{ asset('img/edu/' . $post->image) }}" 
      alt="{{ $post->title }}" 
      class="rounded-lg mb-8 w-full shadow-md object-cover"
    > -->

    <div class="prose max-w-none">
        <p>
            Wakaf adalah perbuatan hukum wakif untuk memisahkan dan/atau menyerahkan
            sebagian harta benda miliknya untuk dimanfaatkan selamanya atau untuk
            jangka waktu tertentu sesuai dengan kepentingannya guna keperluan ibadah
            dan/atau kesejahteraan umum menurut syariah.
        </p>

        <p>
            Secara bahasa, wakaf berasal dari kata Arab <em>waqafa</em> yang berarti
            menahan atau berhenti. Maknanya adalah menahan pokok harta dan
            mengalirkan manfaatnya.
        </p>

        <h2>Dasar Hukum Wakaf</h2>
        <ul>
            <li>Al-Qur’an Surat Ali Imran ayat 92</li>
            <li>Hadis riwayat Muslim</li>
            <li>Undang-Undang No. 41 Tahun 2004 tentang Wakaf</li>
        </ul>
    </div>

    @if($post->sumber)
        <div class="mt-8">
            <a href="{{ $post->sumber }}"
               target="_blank"
               class="text-blue-600 underline">
                Baca sumber resmi
            </a>
        </div>
    @endif

</article>
