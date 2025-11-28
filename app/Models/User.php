<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'nik',
        'nomor_hp',
        'password',
        'verification_code',
        'avatar',
        'verification_code_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'verification_code_expires_at' => 'datetime',
    ];

    /**
     * Boot the model.
     * Pasang event 'deleting' untuk menghapus file avatar terkait.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
        });
    }
}
