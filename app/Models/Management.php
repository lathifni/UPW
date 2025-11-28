<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Management extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'role',
        'description',
        'image',
        'level',
    ];

    /**
     * Boot the model.
     * Pasang event 'deleting' untuk menghapus file foto terkait.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($management) {
            if ($management->photo) {
                Storage::delete('public/management/' . $management->photo);
            }
        });
    }
}
