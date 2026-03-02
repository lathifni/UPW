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

            .form-control:focus,
            .form-select:focus {
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
                                        <label for="nama" class="form-label fw-bold small">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- DROPDOWN KATEGORI BARU --}}
                                    <div class="col-12">
                                        <label for="kategori" class="form-label fw-bold small">Kategori Pengguna</label>
                                        <select class="form-select @error('kategori') is-invalid @enderror"
                                            id="kategori" name="kategori" required onchange="updateLabelIdentitas()">
                                            <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>
                                                Umum</option>
                                            <option value="mahasiswa"
                                                {{ old('kategori') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                                            </option>
                                            <option value="alumni" {{ old('kategori') == 'alumni' ? 'selected' : '' }}>
                                                Alumni</option>
                                            <option value="dosen" {{ old('kategori') == 'dosen' ? 'selected' : '' }}>
                                                Dosen</option>
                                            <option value="tenaga_pendidik"
                                                {{ old('kategori') == 'tenaga_pendidik' ? 'selected' : '' }}>Tenaga
                                                Pendidik</option>
                                        </select>
                                        @error('kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- INPUT NOMOR IDENTITAS (DINAMIS NIK/NIM/NIP) --}}
                                    <div class="col-12">
                                        <label for="nomor_identitas" id="label_identitas"
                                            class="form-label fw-bold small">Nomor Induk Kependudukan (NIK)</label>
                                        <input type="text"
                                            class="form-control @error('nomor_identitas') is-invalid @enderror"
                                            id="nomor_identitas" name="nomor_identitas"
                                            value="{{ old('nomor_identitas') }}" required>
                                        @error('nomor_identitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-bold small">Alamat Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomor_hp" class="form-label fw-bold small">Nomor HP</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">+62</span>
                                            <input type="tel"
                                                class="form-control @error('nomor_hp') is-invalid @enderror"
                                                id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}"
                                                placeholder="81234567890" required>
                                        </div>
                                        @error('nomor_hp')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-bold small">Password</label>
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
                                        <label for="password_confirmation" class="form-label fw-bold small">Konfirmasi
                                            Kata
                                            Sandi</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                        <div class="password-confirmation-status small mt-2"></div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-auth w-100 mt-4 shadow-sm">
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

    @push('scripts')
        <script>
            function updateLabelIdentitas() {
                const kategori = document.getElementById('kategori').value;
                const label = document.getElementById('label_identitas');
                const input = document.getElementById('nomor_identitas');

                if (kategori === 'mahasiswa' || kategori === 'alumni') {
                    label.innerText = 'NIM (Nomor Induk Mahasiswa)';
                    input.placeholder = 'Masukkan NIM Anda';
                } else if (kategori === 'dosen') {
                    label.innerText = 'NIP (Nomor Induk Pegawai)';
                    input.placeholder = 'Masukkan NIP Anda';
                } else {
                    // Untuk Umum dan Tenaga Pendidik
                    label.innerText = 'NIK (Nomor Induk Kependudukan)';
                    input.placeholder = 'Masukkan NIK Anda';
                }
            }

            // Jalankan otomatis sekali pas halaman pertama kali dibuka
            document.addEventListener('DOMContentLoaded', updateLabelIdentitas);
        </script>
    @endpush
</x-layouts.app>
