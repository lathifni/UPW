<x-layouts.app>
    <x-slot:title>Reset Password</x-slot:title>

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
        </style>
    @endpush

    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="auth-card">
                        <div class="auth-header">
                            <div class="auth-logo"><i class="bi bi-key" style="font-size: 2rem;"></i></div>
                            <h4 class="mb-0">Buat Password Baru</h4>
                            <p class="mb-0 opacity-75">Untuk akun: {{ $email }}</p>
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
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                {{-- Input tersembunyi untuk token dan email --}}
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        data-password-validate="true" required>
                                    @include('auth.partials.password-guide')
                                    @error('password')
                                        <div class="text-danger small mt-2">
                                            {{ 'Password yang anda masukkan tidak sesuai dengan ketentuan atau tidak cocok!' }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                    <div class="password-confirmation-status small mt-2"></div>
                                </div>

                                <button type="submit" class="btn btn-success w-100">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
