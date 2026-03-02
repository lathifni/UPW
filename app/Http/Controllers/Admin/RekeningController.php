<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini buat fitur hapus gambar QRIS lama

class RekeningController extends Controller
{
    public function index()
    {
        // Ambil semua data rekening, urutkan dari yang terbaru
        $rekenings = Rekening::latest()->get();

        return view('admin.rekenings.index', compact('rekenings'));
    }

    public function create()
    {
        return view('admin.rekenings.create');
    }

    public function edit($id)
    {
        // Cari data berdasarkan ID
        $rekening = Rekening::findOrFail($id);

        return view('admin.rekenings.edit', compact('rekening'));
    }

    public function store(Request $request)
    {
        // 1. Validasi (logo diganti jadi logo_filename bertipe string)
        $validated = $request->validate([
            'nama_bank'      => 'required|string|max:255',
            'nomor_rekening' => 'required|numeric',
            'atas_nama'      => 'required|string|max:255',
            'is_active'      => 'nullable|boolean',
            'logo_filename'  => 'required|string', // Validasi dari form UI statis
            'qris_image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Default value checkbox
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        // 3. Simpan nama file logo statis ke kolom 'logo'
        $validated['logo'] = $request->logo_filename;

        // 4. Upload QRIS (Bila Ada)
        if ($request->hasFile('qris_image')) {
            $fileName = time() . '_qris.' . $request->qris_image->extension();
            $request->qris_image->storeAs('public/rekenings', $fileName);
            $validated['qris_image'] = $fileName;
        }

        // 5. Simpan ke Database
        Rekening::create($validated);

        return redirect()->route('rekenings.index')->with('success', 'Rekening berhasil ditambahkan!');
    }

    // METHOD UPDATE DITAMBAHKAN
    public function update(Request $request, $id)
    {
        $rekening = Rekening::findOrFail($id);

        $validated = $request->validate([
            'nama_bank'      => 'required|string|max:255',
            'nomor_rekening' => 'required|numeric',
            'atas_nama'      => 'required|string|max:255',
            'is_active'      => 'nullable|boolean',
            'logo_filename'  => 'required|string',
            'qris_image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        // Update logo statis
        $validated['logo'] = $request->logo_filename;

        // Upload QRIS Baru & Hapus yang lama
        if ($request->hasFile('qris_image')) {
            // Hapus file qris lama jika ada
            if ($rekening->qris_image && Storage::exists('public/rekenings/' . $rekening->qris_image)) {
                Storage::delete('public/rekenings/' . $rekening->qris_image);
            }

            $fileName = time() . '_qris.' . $request->qris_image->extension();
            $request->qris_image->storeAs('public/rekenings', $fileName);
            $validated['qris_image'] = $fileName;
        }

        $rekening->update($validated);

        return redirect()->route('rekenings.index')->with('success', 'Rekening berhasil diperbarui!');
    }

    // METHOD DESTROY DITAMBAHKAN BIAR LENGKAP
    public function destroy($id)
    {
        $rekening = Rekening::findOrFail($id);

        // Hapus file qris jika ada saat rekening dihapus
        if ($rekening->qris_image && Storage::exists('public/rekenings/' . $rekening->qris_image)) {
            Storage::delete('public/rekenings/' . $rekening->qris_image);
        }

        $rekening->delete();

        return redirect()->route('rekenings.index')->with('success', 'Rekening berhasil dihapus!');
    }
}
