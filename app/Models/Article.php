<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'slug',
        'category',
        'additional_images',
    ];

    protected $casts = [
        'additional_images' => 'array', // 👈 Ini biar Laravel otomatis ngubah JSON jadi Array
    ];

    /**
     * Get the user that owns the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Boot the model.
     * Pasang event 'deleting' untuk menghapus file gambar terkait.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($article) {
            if ($article->image) {
                Storage::delete('public/articles/' . $article->image);
            }

            // Hapus semua gambar tambahan (looping array-nya)
            if (!empty($article->additional_images)) {
                foreach ($article->additional_images as $imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        });
    }
}
