<x-layouts.admin>
    <x-slot:title>Profil Saya</x-slot:title>

    {{-- Alert Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-left-success" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- CARD INFORMASI PROFIL --}}
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9 col-md-10">
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-circle mr-2"></i>Detail Profil
                    </h6>
                    {{-- Tombol Pemicu Modal --}}
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                        data-target="#editProfileModal">
                        <i class="fas fa-edit fa-sm text-white-50 mr-1"></i> Edit Profil
                    </button>
                </div>
                <div class="card-body text-center py-5">
                    @php
                        $avatarUrl = $user->avatar
                            ? asset('storage/avatars/' . $user->avatar)
                            : asset('storage/avatars/avatar.png');
                    @endphp

                    <div class="position-relative d-inline-block mb-4">
                        <img src="{{ $avatarUrl }}" class="rounded-circle img-thumbnail shadow-sm"
                            style="width: 150px; height: 150px; object-fit: cover;" alt="Avatar Admin">
                    </div>

                    <h3 class="font-weight-bold text-dark mb-1">{{ $user->nama }}</h3>
                    <p class="text-muted mb-2"><i class="fas fa-envelope mr-1"></i> {{ $user->email }}</p>

                    @if ($user->nomor_hp)
                        <p class="text-muted mb-3"><i class="fas fa-phone mr-1"></i> {{ $user->nomor_hp }}</p>
                    @endif

                    <div class="mt-3">
                        <span class="badge badge-primary px-3 py-2 text-uppercase rounded-pill shadow-sm">
                            Role: {{ $user->role }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT PROFIL --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold" id="editProfileModalLabel">Edit Profil Saya</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body px-4 py-4">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="font-weight-bold">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">Alamat Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_hp" class="font-weight-bold">No. HP / WhatsApp</label>
                                    <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror"
                                        id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}"
                                        placeholder="Contoh: 0812xxx">
                                    @error('nomor_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="avatar" class="font-weight-bold">Ganti Foto Profil</label>
                                    <input type="file"
                                        class="form-control-file @error('avatar') is-invalid @enderror" id="avatar"
                                        name="avatar" accept="image/*">
                                    <small class="form-text text-muted">Format: JPG, PNG. Maks: 2MB.</small>
                                    @error('avatar')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h6 class="font-weight-bold text-dark mb-3"><i class="fas fa-lock mr-2 text-warning"></i>Ubah
                            Password</h6>
                        <p class="small text-muted mb-3">Biarkan kosong jika tidak ingin mengubah password.</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" placeholder="Minimal 8 karakter">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Ulangi Password Baru</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Ulangi password baru">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script untuk auto-show modal kalau ada error validasi --}}
    @if ($errors->any())
        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#editProfileModal').modal('show');
                });
            </script>
        @endpush
    @endif

</x-layouts.admin>
