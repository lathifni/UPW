<x-layouts.admin>
    <x-slot:title>Tambah User Baru</x-slot:title>
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>

                {{-- Kategori Pengguna --}}
                <div class="form-group">
                    <label>Kategori Pengguna</label>
                    <select name="kategori" id="kategori" class="form-control" onchange="updateLabelIdentitas()"
                        required>
                        <option value="umum" {{ old('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                        <option value="mahasiswa" {{ old('kategori') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                        </option>
                        <option value="alumni" {{ old('kategori') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="dosen" {{ old('kategori') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="tenaga_pendidik" {{ old('kategori') == 'tenaga_pendidik' ? 'selected' : '' }}>
                            Tenaga Pendidik</option>
                    </select>
                </div>

                {{-- Nomor Identitas Dinamis --}}
                <div class="form-group">
                    <label id="label_identitas">NIK</label>
                    <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas"
                        value="{{ old('nomor_identitas') }}" required>
                </div>

                <div class="form-group">
                    <label>Nomor HP</label>
                    <input type="text" class="form-control" name="nomor_hp" value="{{ old('nomor_hp') }}">
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="donatur">Donatur</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <hr>
                <p class="text-muted">Password</p>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function updateLabelIdentitas() {
                const kategori = document.getElementById('kategori').value;
                const label = document.getElementById('label_identitas');
                const input = document.getElementById('nomor_identitas');

                if (kategori === 'mahasiswa' || kategori === 'alumni') {
                    label.innerText = 'NIM (Nomor Induk Mahasiswa)';
                    input.placeholder = 'Masukkan NIM';
                } else if (kategori === 'dosen') {
                    label.innerText = 'NIP (Nomor Induk Pegawai)';
                    input.placeholder = 'Masukkan NIP';
                } else {
                    label.innerText = 'NIK (Nomor Induk Kependudukan)';
                    input.placeholder = 'Masukkan NIK';
                }
            }
            document.addEventListener('DOMContentLoaded', updateLabelIdentitas);
        </script>
    @endpush
</x-layouts.admin>
