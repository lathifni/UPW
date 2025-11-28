<x-layouts.dashboard>
    <x-slot:title>Profil Saya - Dana Sosial UNAND</x-slot:title>

    <x-slot:hero_content>
        <h1 class="h3 mb-2 fw-bold" style="padding-top: 70px;">Profil Saya</h1>
        <p class="mb-0 opacity-75">Kelola informasi profil dan preferensi akun Anda.</p>
    </x-slot:hero_content>

    @push('styles')
        <style>
            .profile-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 1px solid #e9ecef;
                margin-bottom: 1.5rem;
            }

            .profile-avatar {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                border: 4px solid #198754;
                object-fit: cover;
                margin: 0 auto 1.5rem;
                display: block;
            }

            .stats-badge {
                background: linear-gradient(135deg, #198754, #20c997);
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 2rem;
                font-size: 0.875rem;
            }

            .badge-verified {
                background-color: rgba(25, 135, 84, 0.1);
                /* Latar belakang hijau transparan */
                color: #157347;
                /* Teks hijau tua */
                border: 1px solid rgba(25, 135, 84, 0.2);
            }
        </style>
    @endpush

    {{-- Notifikasi Sukses/Error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Menampilkan error validasi (jika ada) --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Periksa kembali data yang Anda masukkan.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="profile-card">
        <form action="{{ route('dashboard.profile.photo.update') }}" method="POST" enctype="multipart/form-data"
            id="form-upload-avatar">
            @csrf
            <div class="row align-items-center">
                <div class="col-md-3 text-center">

                    {{-- Gambar profil dinamis --}}
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->nama }}"
                            class="profile-avatar" />
                    @else
                        <img src="https://via.placeholder.com/120x120/198754/ffffff?text={{ substr(Auth::user()->nama, 0, 1) }}"
                            alt="{{ Auth::user()->nama }}" class="profile-avatar" />
                    @endif

                    {{-- Input file yang disembunyikan --}}
                    <input type="file" name="avatar" id="avatar-input" class="d-none">

                    {{-- Tombol palsu yang sebenarnya adalah label untuk input file --}}
                    <label for="avatar-input" class="btn btn-outline-success btn-sm" style="cursor: pointer;">
                        <i class="bi bi-camera me-1"></i>Ubah Foto
                    </label>

                </div>
                <div class="col-md-9">
                    <h2 class="mb-2">{{ $user->nama }}</h2>
                    <p class="text-muted mb-3">Bergabung {{ $user->created_at->translatedFormat('F Y') }}</p>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="profile-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Informasi Pribadi</h5>
                    <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil me-1"></i>Edit Informasi
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalUbahPassword">
                        <i class="bi bi-key me-1"></i>Ubah Password
                    </button>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Nama Lengkap</label>
                    <p class="fw-medium">{{ $user->nama }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Email</label>
                    <div class="d-flex align-items-center">
                        <p class="fw-medium mb-0">{{ $user->email }}</p>

                        @if ($user->email_verified_at)
                            <span class="badge badge-verified ms-2"><i class="bi bi-patch-check-fill"></i>
                                Terverifikasi</span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning-emphasis ms-2"><i
                                    class="bi bi-exclamation-triangle-fill"></i> Belum Terverifikasi</span>
                        @endif
                    </div>
                </div>

                {{-- JIKA BELUM TERVERIFIKASI, TAMPILKAN TOMBOL --}}
                @if (!$user->email_verified_at)
                    <div class="alert alert-warning d-flex align-items-center justify-content-between">
                        <span>Email Anda belum terverifikasi.</span>
                        <form action="{{ route('verification.resend') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <button type="submit" class="btn btn-warning btn-sm">Verifikasi Sekarang</button>
                        </form>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label text-muted">Nomor Telepon</label>
                    <p class="fw-medium">{{ $user->nomor_hp }}</p>
                </div>
                <div class="mb-0">
                    <label class="form-label text-muted">NIK</label>
                    <p class="fw-medium">{{ $user->nik }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="profile-card h-100">
                <h5 class="mb-3">Aktivitas Terbaru</h5>
                {{-- TODO: Buat bagian ini dinamis --}}
                <div class="list-group list-group-flush">
                    @forelse ($recent_donations as $donation)
                        <a href="{{ route('dashboard.donations') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                            <div>
                                <i class="bi bi-heart text-success me-2"></i>
                                <span>Donasi ke {{ Str::limit($donation->program->title, 25) }}</span>
                            </div>
                            <small
                                class="text-muted flex-shrink-0 ms-2">{{ $donation->created_at->diffForHumans() }}</small>
                        </a>
                    @empty
                        <div class="list-group-item text-center text-muted px-0">
                            Belum ada aktivitas donasi.
                        </div>
                    @endforelse
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('dashboard.donations') }}" class="btn btn-outline-success btn-sm">Lihat Semua
                        Donasi</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Informasi Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dashboard.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="{{ old('nama', $user->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomor_hp_edit" class="form-label">Nomor Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="tel" class="form-control @error('nomor_hp') is-invalid @enderror"
                                    id="nomor_hp_edit" name="nomor_hp"
                                    value="{{ old('nomor_hp', str_replace('+62', '', $user->nomor_hp)) }}"
                                    placeholder="812..." required>
                            </div>
                            @error('nomor_hp')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly
                                disabled>
                            <small class="form-text text-muted">Email tidak dapat diubah.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" value="{{ $user->nik }}" readonly
                                disabled>
                            <small class="form-text text-muted">NIK tidak dapat diubah.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUbahPassword" tabindex="-1" aria-labelledby="modalUbahPasswordLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUbahPasswordLabel">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dashboard.profile.updatePassword') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password_new" name="password" data-password-validate="true" required>

                            {{-- Memanggil panduan password --}}
                            @include('auth.partials.password-guide')

                            @error('password')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation_new"
                                name="password_confirmation" required>
                            <div class="password-confirmation-status small mt-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Password Baru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Skrip auto-submit avatar (dari kode Anda)
            document.getElementById('avatar-input').addEventListener('change', function() {
                if (this.files.length > 0) {
                    document.getElementById('form-upload-avatar').submit();
                }
            });

            {{-- === PERUBAHAN 5: SKRIP MODAL ERROR YANG DIPERBAIKI === --}}
            @if ($errors->any())
                document.addEventListener('DOMContentLoaded', function() {

                    // Cek jika error ada di modal edit profil
                    @if ($errors->has('nama') || $errors->has('nomor_hp'))
                        var myModal = new bootstrap.Modal(document.getElementById('editProfileModal'));
                        myModal.show();

                        // Cek jika error ada di modal ubah password
                    @elseif ($errors->has('current_password') || $errors->has('password'))
                        var myModal = new bootstrap.Modal(document.getElementById('modalUbahPassword'));
                        myModal.show();
                    @endif
                });
            @endif
        </script>
    @endpush

</x-layouts.dashboard>
