<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WakafCounter extends Model
{
    use HasFactory;

    // Supaya bisa diisi massal
    protected $fillable = [
        'year', 
        'last_number'
    ];
}
