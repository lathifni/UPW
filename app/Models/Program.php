<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'target_amount',
        'is_active',
        'image',
        'category',
        'collected_amount',
        'deadline',
        'is_unggulan',
        'certificate_type',
    ];

    /**
     * Accessor untuk menghitung persentase progres donasi.
     * Bisa diakses seperti: $program->progres_persentase
     */
    public function getProgresPersentaseAttribute(): int
    {
        // Hindari pembagian dengan nol jika target dana adalah 0
        if ($this->target_amount > 0) {
            return (int) (($this->collected_amount / $this->target_amount) * 100);
        }

        return 0;
    }

    /**
     * Accessor untuk memformat nominal dana terkumpul.
     */
    public function getFormattedCollectedAmountAttribute(): string
    {
        $amount = $this->collected_amount;
        if ($amount >= 1000000000) {
            return number_format($amount / 1000000000, 1) . 'M';
        }
        if ($amount >= 1000000) {
            return number_format($amount / 1000000, 1) . 'Jt';
        }
        return number_format($amount);
    }

    /**
     * Accessor untuk memformat nominal target dana.
     */
    public function getFormattedTargetAmountAttribute(): string
    {
        $amount = $this->target_amount;
        if ($amount >= 1000000000) {
            return number_format($amount / 1000000000, 1) . 'M';
        }
        if ($amount >= 1000000) {
            return number_format($amount / 1000000, 1) . 'Jt';
        }
        return number_format($amount);
    }

    /**
    * Accessor untuk menghitung sisa hari dari deadline.
    */
    public function getDaysRemainingAttribute(): ?int
    {
        // Jika tidak ada deadline, kembalikan null
        if (!$this->deadline) {
            return null;
        }

        $deadline = new \DateTime($this->deadline);
        $now = new \DateTime();

        // Jika deadline sudah lewat, kembalikan 0
        if ($now > $deadline) {
            return 0;
        }

        $interval = $now->diff($deadline);
        return $interval->days;
    }

    /**
     * Mendefinisikan relasi bahwa satu program memiliki banyak donasi.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Boot the model.
     * Pasang event 'deleting' untuk menghapus file gambar terkait.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($program) {
            // Cek jika program punya gambar
            if ($program->image) {
                // Hapus file dari storage
                Storage::delete('public/programs/' . $program->image);
            }
        });
    }
}

