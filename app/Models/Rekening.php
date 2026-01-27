<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    // Kita buka semua kolom biar gampang diisi lewat Seeder
    protected $guarded = ['id'];

    // Opsional: Kalau nanti butuh tahu rekening ini dipakai program apa aja
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}