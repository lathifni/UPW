<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string|max:50',
            'additional_images' => 'nullable|array|max:5',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category']);
        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $data['slug'] . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/articles', $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('additional_images')) {
            $additionalImagesArray = [];
            foreach ($request->file('additional_images') as $index => $file) {
                $addImgName = $data['slug'] . '-add-' . $index . '-' . time() . '.' . $file->getClientOriginalExtension();
                // Simpan di folder terpisah biar rapi
                $file->storeAs('public/articles/additional', $addImgName); 
                $additionalImagesArray[] = $addImgName;
            }
            $data['additional_images'] = $additionalImagesArray; // Masukin array ke database
        }

        Article::create($data);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string|max:50',
            'new_additional_images' => 'nullable|array',
            'new_additional_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'delete_images' => 'nullable|array',
        ]);

        $data = $request->only(['title', 'content', 'category']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::delete('public/articles/' . $article->image);
            }
            $image = $request->file('image');
            $imageName = $data['slug'] . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/articles', $imageName);
            $data['image'] = $imageName;
        }

        $currentImages = $article->additional_images ?? []; // Tarik array gambar lama dari DB

        // A. Kalau ada gambar lama yang dicentang buat dihapus
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imgToDelete) {
                Storage::delete('public/articles/additional/' . $imgToDelete); // Hapus fisiknya
                // Hapus namanya dari array
                $currentImages = array_diff($currentImages, [$imgToDelete]);
            }
        }

        // B. Kalau ada gambar tambahan baru yang diupload
        if ($request->hasFile('new_additional_images')) {
            foreach ($request->file('new_additional_images') as $index => $file) {
                // Pastikan total gambar nggak lebih dari 5
                if (count($currentImages) < 5) {
                    $addImgName = $data['slug'] . '-newadd-' . $index . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/articles/additional', $addImgName);
                    $currentImages[] = $addImgName; // Tambahin ke array
                }
            }
        }

        // array_values wajib biar index array ngulang dari 0, json nggak error jadi object
        $data['additional_images'] = array_values($currentImages);

        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // if ($article->image) {
        //     Storage::delete('public/articles/' . $article->image);
        // }
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
