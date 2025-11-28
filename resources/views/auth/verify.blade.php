<x-layouts.app>
    <x-slot:title>Verifikasi Email</x-slot:title>

    @push('styles')
        <style>
            .auth-section {
                min-height: 100vh;
                background: linear-gradient(135deg, #f8fff8 0%, #e8f5e8 100%);
                display: flex;
                align-items: center;
            }

            .auth-card {
                border: none;
                border-radius: 1rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush

    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card auth-card text-center">
                        <div class="card-body p-5">
                            <i class="bi bi-envelope-check-fill text-success" style="font-size: 4rem;"></i>
                            <h3 class="mt-3">Periksa Email Anda</h3>
                            @if (session('email'))
                                <p class="text-muted">Kami telah mengirimkan 6-digit kode verifikasi ke
                                    <strong>{{ session('email') }}</strong>.
                                </p>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif

                            <form action="{{ route('verification.verify') }}" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{ session('email') }}">
                                <div class="mb-3">
                                    <label for="verification_code" class="form-label">Masukkan Kode</label>
                                    <input type="text" class="form-control form-control-lg text-center"
                                        id="verification_code" name="verification_code" required autofocus
                                        maxlength="6" style="letter-spacing: 10px;">
                                </div>
                                <button type="submit" class="btn btn-success w-100">Verifikasi Akun</button>
                            </form>

                            <div class="mt-3">
                                <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ session('email') }}">
                                    <button type="submit" id="resend-button" class="btn btn-link">Kirim ulang
                                        kode</button>
                                </form>
                                |
                                <a href="{{ route('verification.skip') }}" class="btn btn-link">Lewati untuk
                                    sekarang</a>
                            </div>

                            <div id="countdown-timer" class="text-danger fw-bold small mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        {{-- Pastikan ada data expires_at sebelum menjalankan skrip --}}
        @if ($expires_at)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const expiresAt = new Date("{{ $expires_at }}").getTime();
                    const countdownElement = document.getElementById('countdown-timer');
                    const resendButton = document.getElementById('resend-button');

                    // Nonaktifkan tombol kirim ulang pada awalnya
                    resendButton.disabled = true;

                    const interval = setInterval(function() {
                        const now = new Date().getTime();
                        const distance = expiresAt - now;

                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        if (distance < 0) {
                            clearInterval(interval);
                            countdownElement.innerHTML = "Kode verifikasi telah kedaluwarsa.";
                            resendButton.disabled = false; // Aktifkan tombol kirim ulang
                        } else {
                            // Tambahkan '0' di depan jika angka < 10
                            const displaySeconds = seconds < 10 ? '0' + seconds : seconds;
                            countdownElement.innerHTML = "Kode akan kedaluwarsa dalam: " + minutes + ":" +
                                displaySeconds;
                        }
                    }, 1000);
                });
            </script>
        @endif
    @endpush
</x-layouts.app>
