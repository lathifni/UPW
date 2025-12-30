<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'user_id',
        'order_id',
        'amount',
        'status',
        'donation_type',
        'nomor_akte',
        'tgl_akte',
        'donor_name',
        'donor_email',
        'payment_type',
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

    public function generateAkteNumber()
    {
        // 1. Cek: Kalau sudah punya nomor, jangan generate lagi (Safety)
        if ($this->nomor_akte) {
            return;
        }

        // 2. Bungkus dalam Transaction biar Aman
        DB::transaction(function () {
            
            $currentYear = now()->year; // Tahun saat ini (misal: 2025)

            // 3. Cari Counter untuk Tahun ini. Kalau gak ada, buat baru mulai dari 0.
            $counter = WakafCounter::firstOrCreate(
                ['year' => $currentYear],
                ['last_number' => 0]
            );

            // 4. LOCK FOR UPDATE (PENTING!)
            // Kita kunci baris ini sebentar supaya user lain gak bisa baca/tulis
            // sampai proses kita selesai. Ini mencegah nomor kembar.
            $counter = WakafCounter::where('id', $counter->id)->lockForUpdate()->first();

            // 5. Tambah Angkanya (+1)
            $newNumber = $counter->last_number + 1;

            // 6. Update Papan Skor (Counter)
            $counter->update(['last_number' => $newNumber]);

            // 7. Format Nomor Cantik
            // Format: 001/WK-UANG/UNAND/2025
            // str_pad(1, 3, '0', STR_PAD_LEFT) -> jadinya "001"
            $formattedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT) . '/AIW-U/UPW-UNAND/VIII' . $currentYear;

            // 8. Simpan ke Diri Sendiri (Donation)
            $this->update([
                'nomor_akte' => $formattedNumber,
                'tgl_akte'   => now(), // Simpan tanggal saat nomor dibuat
            ]);
        });
    }
}
