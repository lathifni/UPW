<x-layouts.admin>
    <x-slot:title>Tambah User Baru</x-slot:title>
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group"><label>Nama Lengkap</label><input type="text" class="form-control" name="nama"
                        value="{{ old('nama') }}"></div>
                <div class="form-group"><label>Email</label><input type="email" class="form-control" name="email"
                        value="{{ old('email') }}"></div>
                <div class="form-group"><label>NIK</label><input type="text" class="form-control" name="nik"
                        value="{{ old('nik') }}"></div>
                <div class="form-group"><label>Nomor HP</label><input type="text" class="form-control"
                        name="nomor_hp" value="{{ old('nomor_hp') }}"></div>
                <div class="form-group"><label>Role</label><select name="role" class="form-control">
                        <option value="donatur">Donatur</option>
                        <option value="admin">Admin</option>
                    </select></div>
                <hr>
                <p class="text-muted">Password</p>
                <div class="form-group"><label>Password</label><input type="password" class="form-control"
                        name="password"></div>
                <div class="form-group"><label>Konfirmasi Password</label><input type="password" class="form-control"
                        name="password_confirmation"></div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
