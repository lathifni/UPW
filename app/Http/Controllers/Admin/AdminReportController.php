<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index()
    {
        $reports = \App\Models\Report::latest()->get();
        return view('admin.reports.index', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'required|numeric',
            'file' => 'required|mimes:pdf|max:5120', // Max 5MB, PDF Only
        ]);

        // Upload PDF
        $filename = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('public/reports', $filename);

        \App\Models\Report::create([
            'title' => $request->title,
            'year' => $request->year,
            'file_path' => $filename
        ]);

        return back()->with('success', 'Laporan berhasil diupload!');
    }

    public function destroy($id)
    {
        $report = \App\Models\Report::findOrFail($id);
        
        // Hapus file fisik biar server gak penuh
        \Storage::delete('public/reports/' . $report->file_path);
        
        $report->delete();
        return back()->with('success', 'File laporan dihapus.');
    }
}
