<x-layouts.app>
    <x-slot:title>Daftar - Dana Sosial UNAND</x-slot:title>

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

            .progress-bar {
                background-color: #198754;
            }

            .step-indicator {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #dee2e6;
                color: #6c757d;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.875rem;
                font-weight: 600;
            }

            .step-indicator.active {
                background: #198754;
                color: white;
            }

            .step-label {
                font-size: 0.875rem;
                color: #6c757d;
                margin-top: 0.5rem;
            }

            .step-label.active {
                color: #198754;
                font-weight: 600;
            }
        </style>
    @endpush

    <section class="auth-section">
        <div class="container" style="margin-top: 100px; margin-bottom: 90px;">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="auth-card">
                        <div class="auth-header">
                            <div class="auth-logo">
                                <i class="bi bi-person-plus" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="mb-0">Buat Akun Baru</h4>
                            <p class="mb-0 opacity-75">Bergabunglah dengan komunitas peduli UNAND</p>
                        </div>

                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            id="nik" name="nik" value="{{ old('nik') }}" required>
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomor_hp" class="form-label">Nomor HP</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+62</span>
                                            <input type="tel"
                                                class="form-control @error('nomor_hp') is-invalid @enderror"
                                                id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}"
                                                placeholder="81234567890" required>
                                        </div>
                                        @error('nomor_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            data-password-validate="true" required>
                                        @include('auth.partials.password-guide')
                                        @error('password')
                                            <div class="text-danger small mt-2">
                                                {{ 'Password yang anda masukkan tidak sesuai dengan ketentuan atau tidak cocok!' }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Kata
                                            Sandi</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                        <div class="password-confirmation-status small mt-2"></div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-auth w-100 mt-4">
                                    Daftar Sekarang
                                </button>

                                <div class="text-center mt-3">
                                    <p class="mb-0">Sudah punya akun?
                                        <a href="{{ route('login') }}"
                                            class="text-success text-decoration-none fw-bold">Masuk di sini</a>
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
