<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Rekening; // <--- Jangan lupa import model Rekening di paling atas

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::latest()->get();
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rekenings = Rekening::where('is_active', true)->get();

        return view('admin.programs.create', compact('rekenings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:50',
            'target_amount' => 'nullable|numeric|min:0', // <--- UBAH JADI NULLABLE
            'deadline' => 'nullable|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rekening_id' => 'required|exists:rekenings,id',
        ]);

        $data = $request->only(['title', 'description', 'category', 'deadline', 'certificate_type', 'rekening_id']);

        // Logika pengamanan backend:
        // Jika Wakaf Uang/Dana Abadi, paksa target jadi 0, selain itu ambil dari request
        if (in_array($request->category, ['Wakaf Uang', 'Dana Abadi'])) {
            $data['target_amount'] = 0;
            $data['deadline'] = null; // Opsional: paksa deadline null buat dana abadi
        } else {
            $data['target_amount'] = $request->target_amount;
        }

        $data['is_unggulan'] = $request->has('is_unggulan');
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/programs', $imageName);
            $data['image'] = $imageName;
        }

        Program::create($data);

        return redirect()->route('programs.index')->with('success', 'Program berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        // Route-model binding akan otomatis mencari program berdasarkan ID
        $rekenings = Rekening::where('is_active', true)->get();
        return view('admin.programs.edit', compact('program', 'rekenings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:50',
            'target_amount' => 'nullable|numeric|min:0', // <--- UBAH JADI NULLABLE
            'deadline' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rekening_id' => 'required|exists:rekenings,id',
        ]);

        $data = $request->only(['title', 'description', 'category', 'deadline', 'certificate_type', 'rekening_id']);

        // Logika pengamanan backend:
        if (in_array($request->category, ['Wakaf Uang', 'Dana Abadi'])) {
            $data['target_amount'] = 0;
            $data['deadline'] = null;
        } else {
            $data['target_amount'] = $request->target_amount;
        }

        $data['is_unggulan'] = $request->has('is_unggulan');

        if ($request->hasFile('image')) {
            if ($program->image) {
                Storage::delete('public/programs/' . $program->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/programs', $imageName);
            $data['image'] = $imageName;
        }

        $program->update($data);

        return redirect()->route('programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        // 1. Hapus gambar dari storage
        if ($program->image) {
            Storage::delete('public/programs/' . $program->image);
        }

        // 2. Hapus data dari database
        $program->delete();

        // 3. Redirect dengan pesan sukses
        return redirect()->route('programs.index')
                         ->with('success', 'Program berhasil dihapus.');
    }
}
