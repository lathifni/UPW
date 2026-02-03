<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rekening; // Pastikan Model Rekening sudah ada
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function index()
    {
        // Ambil semua data rekening, urutkan dari yang terbaru
        $rekenings = Rekening::latest()->get();

        // Kembalikan ke view dengan membawa data $rekenings
        return view('admin.rekenings.index', compact('rekenings'));
    }

    // Nanti kamu juga butuh method create, store, edit, update, destroy di sini
    public function create() {
        return view('admin.rekenings.create');
    }
    
    public function edit($id)
    {
        // Cari data berdasarkan ID
        $rekening = Rekening::findOrFail($id);
        
        // Kirim ke view
        return view('admin.rekenings.edit', compact('rekening'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'nama_bank'      => 'required|string|max:255',
            'nomor_rekening' => 'required|numeric', // atau string kalau mau support dash
            'atas_nama'      => 'required|string|max:255',
            'is_active'      => 'nullable|boolean',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'qris_image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Default value checkbox (kalau unchecked dia null)
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        // 3. Upload Logo
        if ($request->hasFile('logo')) {
            $fileName = time() . '_logo.' . $request->logo->extension();
            $request->logo->storeAs('public/rekenings', $fileName);
            $validated['logo'] = $fileName;
        }

        // 4. Upload QRIS
        if ($request->hasFile('qris_image')) {
            $fileName = time() . '_qris.' . $request->qris_image->extension();
            $request->qris_image->storeAs('public/rekenings', $fileName);
            $validated['qris_image'] = $fileName;
        }

        // 5. Simpan ke Database
        Rekening::create($validated);

        return redirect()->route('rekenings.index')->with('success', 'Rekening berhasil ditambahkan!');
    }
}