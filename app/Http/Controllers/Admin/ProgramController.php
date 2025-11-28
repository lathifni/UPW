<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.programs.create');
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
        'target_amount' => 'required|numeric|min:0',
        'deadline' => 'nullable|date', 
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'category', 'target_amount', 'deadline', 'certificate_type']);
        $data['is_unggulan'] = $request->has('is_unggulan');

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
        return view('admin.programs.edit', compact('program'));
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
            'target_amount' => 'required|numeric|min:0',
            'deadline' => 'nullable|date', // <-- Tambah validasi
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'category', 'target_amount', 'deadline', 'certificate_type']);
        $data['is_unggulan'] = $request->has('is_unggulan'); // <-- Tambahkan baris ini

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
