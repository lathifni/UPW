<x-layouts.app>
    <x-slot:title>Pusat Edukasi Wakaf - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            /* 1. HERO SECTION (Tetap Hijau Khas Wakaf) */
            .education-hero {
                background: linear-gradient(135deg,
                        rgba(25, 135, 84, 0.9) 0%,
                        rgba(32, 201, 151, 0.9) 100%),
                    url("https://images.unsplash.com/photo-1576764402988-7143f9cca90a?q=80&w=1920&auto=format&fit=crop") center/cover;
                color: white;
                padding: 120px 0 100px;
                position: relative;
                overflow: hidden;
            }

            /* Hiasan background abstrak */
            .education-hero::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 100px;
                background: linear-gradient(to top, #fff, transparent);
                opacity: 0.1;
            }

            /* 2. STYLE ACCORDION (Dropdown QnA) */
            .accordion-item {
                border: 1px solid #e9ecef;
                border-radius: 12px !important;
                margin-bottom: 1rem;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0,0,0,0.02);
                transition: all 0.3s ease;
            }

            .accordion-item:hover {
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                border-color: #198754;
            }

            .accordion-button {
                font-weight: 600;
                color: #2c3e50;
                background-color: #fff;
                padding: 1.25rem;
                font-size: 1.05rem;
            }

            .accordion-button:not(.collapsed) {
                color: #198754; /* Warna Ijo Pas Dibuka */
                background-color: #f8fdfa; /* Background Ijo Pudar Pas Dibuka */
                box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
            }

            .accordion-button:focus {
                box-shadow: none; /* Hilangkan border biru default */
                border-color: rgba(25, 135, 84, 0.5);
            }

            /* Ganti panah default jadi ijo */
            .accordion-button::after {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23198754'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            }

            .accordion-body {
                line-height: 1.7;
                color: #6c757d;
                padding: 1.5rem;
            }

            /* 3. KARTU DEFINISI */
            .definition-card {
                background: #fff;
                padding: 2rem;
                border-radius: 15px;
                height: 100%;
                border-bottom: 5px solid #198754;
                box-shadow: 0 10px 30px rgba(0,0,0,0.05);
                transition: transform 0.3s;
            }
            .definition-card:hover {
                transform: translateY(-5px);
            }
            .icon-box {
                width: 60px;
                height: 60px;
                background: #e9f7ef;
                color: #198754;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
        </style>
    @endpush

    <section class="education-hero text-center">
        <div class="container position-relative z-index-1">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                <i class="bi bi-book-half me-2"></i>PUSAT PENGETAHUAN
            </span>
            <h1 class="display-4 fw-bold mb-2">Kamus & Edukasi Wakaf</h1>
            <p class="lead text-white-50 mb-2 mx-auto" style="max-width: 700px;">
                Temukan jawaban atas pertanyaan Anda seputar wakaf, hukum, manfaat, dan tata cara pelaksanaannya di Universitas Andalas.
            </p>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container" style="margin-top: -200px; position: relative; z-index: 2;">
            <div class="row g-4">
              {{-- ITEM 1 --}}
              <div class="col-md-4">
                  {{-- Tambah text-center di parent biar paragrafnya ikutan tengah --}}
                  <div class="definition-card text-center">
                      {{-- TAMBAH mx-auto DI SINI --}}
                      <div class="icon-box mx-auto"><i class="bi bi-person-heart"></i></div>
                      <h4 class="fw-bold mb-3">Wakif</h4>
                      <p class="text-muted">Pihak yang mewakafkan harta bendanya. Siapapun bisa menjadi Wakif, baik perorangan maupun badan hukum.</p>
                  </div>
              </div>

              {{-- ITEM 2 --}}
              <div class="col-md-4">
                  <div class="definition-card text-center">
                      {{-- TAMBAH mx-auto DI SINI --}}
                      <div class="icon-box mx-auto"><i class="bi bi-building-check"></i></div>
                      <h4 class="fw-bold mb-3">Nazhir</h4>
                      <p class="text-muted">Pihak yang menerima harta benda wakaf dari Wakif untuk dikelola dan dikembangkan sesuai peruntukannya (UPW UNAND).</p>
                  </div>
              </div>

              {{-- ITEM 3 --}}
              <div class="col-md-4">
                  <div class="definition-card text-center">
                      {{-- TAMBAH mx-auto DI SINI --}}
                      <div class="icon-box mx-auto"><i class="bi bi-people"></i></div>
                      <h4 class="fw-bold mb-3">Mauquf 'Alaih</h4>
                      <p class="text-muted">Pihak yang ditunjuk untuk memperoleh manfaat dari peruntukan harta benda wakaf (Mahasiswa, Dosen, Masyarakat).</p>
                  </div>
              </div>
          </div>
        </div>
    </section>

    <section class="py-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-success">Pertanyaan Umum (FAQ)</h2>
                        <p class="text-muted">Hal-hal yang sering ditanyakan seputar Wakaf UNAND</p>
                    </div>

                    {{-- GROUP 1: DASAR WAKAF --}}
                    <h5 class="fw-bold text-dark mb-3 ps-2 border-start border-4 border-success">Dasar & Hukum Wakaf</h5>
                    <div class="accordion mb-5" id="accordionBasic">
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Apa perbedaan Wakaf dengan Zakat atau Sedekah?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionBasic">
                                <div class="accordion-body">
                                    <strong>Zakat</strong> hukumnya wajib bagi yang mampu dan ada nishabnya. 
                                    <strong>Sedekah</strong> bersifat sunnah dan bebas. 
                                    Sedangkan <strong>Wakaf</strong> adalah menahan pokok harta dan mengalirkan manfaatnya. 
                                    Dalam wakaf, harta pokok tidak boleh habis/dijual, tapi manfaatnya (hasil investasinya) yang digunakan untuk umat. Pahalanya terus mengalir (Jariyah) meskipun wakif sudah meninggal.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    Apakah boleh berwakaf dengan uang tunai?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionBasic">
                                <div class="accordion-body">
                                    <strong>Sangat Boleh.</strong> Majelis Ulama Indonesia (MUI) telah mengeluarkan fatwa tentang kebolehan Wakaf Uang. Uang yang diwakafkan akan dikelola sebagai dana abadi, diinvestasikan, dan hasil keuntungannya yang akan disalurkan untuk beasiswa atau pembangunan, tanpa mengurangi nilai pokok uang tersebut.
                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- GROUP 2: TEKNIS DI UNAND --}}
                    <h5 class="fw-bold text-dark mb-3 ps-2 border-start border-4 border-warning">Teknis Wakaf di UNAND</h5>
                    <div class="accordion" id="accordionTeknis">
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    Bagaimana cara mendapatkan sertifikat wakaf?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                                <div class="accordion-body">
                                    Setiap donatur yang berwakaf di atas nominal tertentu (misal Rp 1.000.000) berhak mendapatkan Sertifikat Wakaf digital yang akan dikirimkan ke email. Untuk donasi Wakaf Uang Abadi dengan nominal besar, kami juga menyediakan Akta Ikrar Wakaf resmi.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    Kemana dana wakaf saya akan disalurkan?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionTeknis">
                                <div class="accordion-body">
                                    Penyaluran dana bergantung pada program yang Anda pilih:
                                    <ul>
                                        <li><strong>Wakaf Uang (Dana Abadi):</strong> Pokoknya diinvestasikan, hasilnya untuk beasiswa dan riset.</li>
                                        <li><strong>Wakaf Fasilitas:</strong> Digunakan langsung untuk pembangunan masjid, kelas, atau RS UNAND.</li>
                                        <li><strong>Program Insidentil:</strong> Seperti bantuan bencana alam.</li>
                                    </ul>
                                    Anda dapat melihat laporan penyaluran secara transparan di menu Laporan.
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-success-subtle text-center">
        <div class="container">
            <h3 class="fw-bold text-success mb-3">Sudah Paham tentang Wakaf?</h3>
            <p class="text-muted mb-4">Mari mulai langkah kebaikan Anda hari ini. Harta kekal, pahala mengalir.</p>
            <a href="{{ route('programs.index.public') }}" class="btn btn-success btn-lg px-5 rounded-pill shadow hover-lift">
                <i class="bi bi-heart-fill me-2"></i> Mulai Berwakaf
            </a>
        </div>
    </section>

</x-layouts.app>