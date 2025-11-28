<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'user_id',
        'order_id',
        'amount',
        'status',
        'donation_type'
    ];

    /**
     * Mendefinisikan relasi bahwa donasi ini milik satu program.
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Mendefinisikan relasi bahwa donasi ini milik satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
