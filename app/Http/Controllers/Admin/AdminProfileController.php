<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User; // <-- Wajib ada biar save() berfungsi

class AdminProfileController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = auth()->user();

        // Panggil halaman profile.blade.php yang udah lu siapin
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        // 1. Ambil ID user yang login
        $userId = auth()->id();

        // 2. Gunakan Model User untuk nge-load datanya
        $user = User::findOrFail($userId);

        // 3. Validasi Data
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'nomor_hp' => 'nullable|string|max:20', // Tambahan dari struktur tabel lu
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 4. Update field teks
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->nomor_hp = $request->nomor_hp;

        // 5. Update Password JIKA DIISI saja
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 6. Update Foto Profil JIKA ADA FILE
        if ($request->hasFile('avatar')) {
            // Hapus foto lama biar nggak menuhin storage (kecuali avatar default)
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            // Simpan foto baru
            $fileName = time() . '_avatar.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $fileName);
            $user->avatar = $fileName;
        }

        // 7. Simpan Perubahan
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
