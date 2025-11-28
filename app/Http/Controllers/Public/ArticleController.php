<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
   public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->latest()->paginate(10);

        $stats = [
            'total_articles' => Article::count(),
            'total_views' => Article::sum('views'),
            'total_categories' => Article::distinct()->count('category'),
            'total_authors' => Article::distinct()->count('user_id'),
        ];

        $category_counts = Article::query()
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category');

        $categories = Article::select('category')->whereNotNull('category')->distinct()->pluck('category');

        // --- BARIS INI DITAMBAHKAN KEMBALI ---
        $recent_articles = Article::latest()->take(5)->get();

        // --- 'recent_articles' DIMASUKKAN KEMBALI KE compact() ---
        return view('public.articles.index', compact('articles', 'stats', 'category_counts', 'categories', 'recent_articles'));
    }

    public function show(Article $article)
    {
        $article->increment('views');

        // Ambil 3 berita terkait (selain berita yang sedang dibuka)
        $related_articles = Article::where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.articles.show', compact('article', 'related_articles'));
    }
}
