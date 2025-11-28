<x-layouts.app>
    <x-slot:title>Login - Dana Sosial UNAND</x-slot:title>

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

            .form-control:focus {
                border-color: #198754;
                box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
            }

            .btn-auth {
                padding: 0.75rem 2rem;
                font-weight: 600;
            }

            .auth-divider {
                position: relative;
                text-align: center;
                margin: 2rem 0;
            }

            .auth-divider::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                height: 1px;
                background: #dee2e6;
            }

            .auth-divider span {
                background: white;
                padding: 0 1rem;
                position: relative;
                color: #6c757d;
            }
        </style>
    @endpush

    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="auth-card">
                        <div class="auth-header">
                            <div class="auth-logo">
                                <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="mb-0">Masuk ke Akun Anda</h4>
                            <p class="mb-0 opacity-75">Selamat datang kembali!</p>
                        </div>

                        <div class="card-body p-4">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}"
                                            placeholder="email@example.com" required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Masukkan kata sandi" required>
                                    </div>
                                </div>

                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                                    </div>
                                    <a href="{{ route('password.phone.request') }}"
                                        class="text-success text-decoration-none small">Lupa kata sandi?</a>
                                </div>

                                <button type="submit" class="btn btn-success btn-auth w-100 mb-3">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                                </button>

                                <div class="text-center">
                                    <p class="mb-0">Belum punya akun?
                                        <a href="{{ route('register') }}"
                                            class="text-success text-decoration-none fw-bold">Daftar di sini</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
