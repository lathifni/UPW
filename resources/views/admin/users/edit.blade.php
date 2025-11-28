<x-layouts.admin>
    <x-slot:title>Edit User</x-slot:title>
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit User</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group"><label>Nama Lengkap</label><input type="text" class="form-control" name="nama"
                        value="{{ old('nama', $user->nama) }}"></div>
                <div class="form-group"><label>Email</label><input type="email" class="form-control" name="email"
                        value="{{ old('email', $user->email) }}" readonly></div>
                <div class="form-group"><label>NIK</label><input type="text" class="form-control" name="nik"
                        value="{{ old('nik', $user->nik) }}"></div>
                <div class="form-group"><label>Nomor HP</label><input type="text" class="form-control"
                        name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}"></div>
                <div class="form-group"><label>Role</label><select name="role" class="form-control">
                        <option value="donatur" {{ $user->role == 'donatur' ? 'selected' : '' }}>Donatur</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select></div>
                <hr>
                <p class="text-muted">Kosongkan password jika tidak ingin mengubahnya.</p>
                <div class="form-group"><label>Password Baru</label><input type="password" class="form-control"
                        name="password"></div>
                <div class="form-group"><label>Konfirmasi Password Baru</label><input type="password"
                        class="form-control" name="password_confirmation"></div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
