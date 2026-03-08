<footer class="footer bg-dark text-white pt-5 rounded-top-2">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-4">
                    <a href="https://www.unand.ac.id/" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('frontend/img/unand-emas2-small.png') }}" alt="UNAND" height="80"
                            class="d-block mb-2">
                    </a>
                    <a href="https://www.unand.ac.id/" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('frontend/img/kedjajaan_bangsa.png') }}" alt="Kedjajaan Bangsa" height="70"
                        class="d-block ">
                    </a>
                    
                    <h5 class="text-white">Dana Sosial UNAND</h5>
                    <p class="footer-description">Platform resmi untuk menggalang dana sosial, zakat, dan dana abadi
                        Universitas Andalas demi kemajuan pendidikan dan kesejahteraan masyarakat.</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div>
                    <h6 class="footer-title mb-3">Tautan Cepat</h6>
                    <ul class="footer-links">
                        {{-- Mengarah ke halaman utama (Home) --}}
                        <li><a href="{{ url('/') }}">Home</a></li>
                        
                        {{-- Mengarah ke halaman Wakaf Uang --}}
                        <li><a href="{{ route('public.wakaf-uang') }}">Wakaf Uang</a></li>
                        
                        {{-- Mengarah ke daftar Wakaf Melalui Uang --}}
                        <li><a href="{{ route('wakaf-melalui-uang.index.public') }}">Wakaf Melalui Uang</a></li>
                        
                        {{-- Mengarah ke daftar Berita/Artikel --}}
                        <li><a href="{{ route('articles.index.public') }}">Berita</a></li>
                        
                        {{-- Mengarah ke halaman Kepengurusan (Sesuaikan nama route-nya kalau beda) --}}
                        <li><a href="{{ url('/kepengurusan') }}">Kepengurusan</a></li>

                        {{-- Mengarah ke halaman Kepengurusan (Sesuaikan nama route-nya kalau beda) --}}
                        <li><a href="{{ url('/sejarah') }}">Sejarah</a></li>
                        
                        {{-- Mengarah ke halaman Edukasi (Sesuaikan nama route-nya kalau beda) --}}
                        <li><a href="{{ url('/edukasi-wakaf') }}">Edukasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div>
                    <h6 class="footer-title mb-3">Kontak</h6>
                    <div class="contact-info">
                        <p class="contact-item">
                            <i class="bi bi-geo-alt me-2"></i>
                            Kampus Universitas Andalas<br>
                            Limau Manis, Padang 25163
                        </p>
                        <p class="contact-item">
                            <i class="bi bi-telephone me-2"></i>
                            +62 751 71181
                        </p>
                        <p class="contact-item">
                            <i class="bi bi-envelope me-2"></i>
                            danasosial@unand.ac.id
                        </p>
                        <p class="contact-item">
                            <i class="bi bi-bell me-2"></i>
                            notifikasi.upw.unand@gmail.com
                        </p>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-3 col-md-6">
                <div>
                    <h6 class="footer-title mb-3">Jam Operasional</h6>
                    <div class="operational-hours">
                        <p class="mb-2">Senin - Kamis: 08:00 - 16:00</p>
                        <p class="mb-2">Jumat: 08:00 - 11:00</p>
                        <p class="mb-2">Sabtu - Minggu: Tutup</p>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title mb-3">Ikuti Kami</h6>
                    <div class="social-links">
                        <a href="#" class="social-link me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link me-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="social-link me-2"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link me-2"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
        </div>

        <!-- <hr class="footer-divider mb-1"> -->

        <div class="row align-items-center">
            <div class="col-12 text-center">
                <p class="copyright mb-0">
                    &copy; <span id="year"></span> Dana Sosial UNAND. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
@endpush
