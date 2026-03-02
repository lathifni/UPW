<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Dasar
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,donatur',
            'kategori' => 'required|in:mahasiswa,alumni,dosen,tenaga_pendidik,umum',
            'nomor_identitas' => 'required|string|max:50',
            'nomor_hp' => 'nullable|string|max:15',
        ]);

        // 2. Validasi Keunikan NIK (Hanya jika Umum/Tendik)
        if (in_array($request->kategori, ['umum', 'tenaga_pendidik'])) {
            $request->validate([
                'nomor_identitas' => 'unique:users,nik'
            ], [
                'nomor_identitas.unique' => 'NIK ini sudah terdaftar.'
            ]);
        }

        // 3. Logika Pemisahan NIK vs Nomor Induk
        $nik = in_array($request->kategori, ['umum', 'tenaga_pendidik']) ? $request->nomor_identitas : null;
        $nomor_induk = in_array($request->kategori, ['mahasiswa', 'alumni', 'dosen']) ? $request->nomor_identitas : null;

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'kategori' => $request->kategori,
            'nik' => $nik,
            'nomor_induk' => $nomor_induk,
            'nomor_hp' => $request->nomor_hp,
            'email_verified_at' => now(), // Auto verifikasi kalau ditambah admin
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // 1. Validasi Dasar
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,donatur',
            'password' => 'nullable|string|min:8|confirmed',
            'kategori' => 'required|in:mahasiswa,alumni,dosen,tenaga_pendidik,umum',
            'nomor_identitas' => 'required|string|max:50',
            'nomor_hp' => 'nullable|string|max:15',
        ]);

        // 2. Validasi Keunikan NIK (Abaikan ID user yang sedang di-edit)
        if (in_array($request->kategori, ['umum', 'tenaga_pendidik'])) {
            $request->validate([
                'nomor_identitas' => Rule::unique('users', 'nik')->ignore($user->id)
            ], [
                'nomor_identitas.unique' => 'NIK ini sudah terdaftar untuk user lain.'
            ]);
        }

        // 3. Logika Pemisahan NIK vs Nomor Induk
        $nik = in_array($request->kategori, ['umum', 'tenaga_pendidik']) ? $request->nomor_identitas : null;
        $nomor_induk = in_array($request->kategori, ['mahasiswa', 'alumni', 'dosen']) ? $request->nomor_identitas : null;

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'kategori' => $request->kategori,
            'nik' => $nik,
            'nomor_induk' => $nomor_induk,
            'nomor_hp' => $request->nomor_hp,
        ];

        // 4. Update password kalau admin ngisi inputnya
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Jangan biarkan user menghapus dirinya sendiri
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
