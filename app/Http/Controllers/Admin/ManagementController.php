<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ManagementController extends Controller
{
    public function index()
    {
        $managements = Management::orderBy('level')->get();
        return view('admin.managements.index', compact('managements'));
    }

    public function create()
    {
        return view('admin.managements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'role' => 'nullable|string|max:255', // Role boleh null
        'level' => 'required|in:penanggung-jawab,dewan-pengawas,anggota-upw',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'description' => 'nullable|string',
    ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/managements', $fileName);
            $data['image'] = $fileName;
        }

        Management::create($data);

        return redirect()->route('managements.index')->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function edit(Management $management)
    {
        return view('admin.managements.edit', compact('management'));
    }

    public function update(Request $request, Management $management)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'role' => 'nullable|string|max:255', // Role boleh null
        'level' => 'required|in:penanggung-jawab,dewan-pengawas,anggota-upw',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'description' => 'nullable|string',
    ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($management->image) {
                Storage::delete('public/managements/' . $management->image);
            }
            $file = $request->file('image');
            $fileName = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/managements', $fileName);
            $data['image'] = $fileName;
        }

        $management->update($data);

        return redirect()->route('managements.index')->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Management $management)
    {
        if ($management->image) {
            Storage::delete('public/managements/' . $management->image);
        }
        $management->delete();

        return redirect()->route('managements.index')->with('success', 'Data pengurus berhasil dihapus.');
    }
}
