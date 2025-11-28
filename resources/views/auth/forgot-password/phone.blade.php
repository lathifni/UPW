<x-layouts.app>
    <x-slot:title>Lupa Password</x-slot:title>

    @push('styles')
        {{-- Kita gunakan style yang sama dengan halaman login --}}
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

            .auth-header {
                background: linear-gradient(135deg, #198754, #157347);
                color: white;
                border-radius: 1rem 1rem 0 0;
                padding: 2rem;
                text-align: center;
            }

            .auth-logo {
                width: 80px;
                height: 80px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
            }
        </style>
    @endpush

    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="auth-card">
                        <div class="auth-header">
                            <div class="auth-logo"><i class="bi bi-shield-lock" style="font-size: 2rem;"></i></div>
                            <h4 class="mb-0">Lupa Password</h4>
                            <p class="mb-0 opacity-75">Kami akan bantu memulihkan akun Anda</p>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-muted text-center">Masukkan nomor telepon yang terdaftar pada akun Anda. Kami
                                akan mengirimkan link untuk reset password ke email yang terkait.</p>

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.phone.send') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="nomor_hp" class="form-label">Nomor Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+62</span>
                                        <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp"
                                            placeholder="81234567890" required autofocus>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success w-100 mb-3">Kirim Link Reset</button>
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="text-success text-decoration-none">Kembali ke
                                        halaman Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
