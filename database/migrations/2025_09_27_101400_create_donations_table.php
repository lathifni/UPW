<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            // 1. RELASI USER (Nullable buat Guest)
            // 'constrained' otomatis nyari tabel 'users'. 
            // 'nullOnDelete' artinya kalau user dihapus, data donasi TETAP ADA (user_id jadi null)
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            
            // 2. RELASI PROGRAM
            $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete();

            // 3. DATA TAMU (PENTING BUAT WAKAF TANPA LOGIN)
            // Kalau user login, ini boleh null (ambil dari tabel user).
            // Kalau guest, ini wajib diisi via controller.
            $table->string('donor_name')->nullable();
            $table->string('donor_email')->nullable();

            $table->enum('donation_type', ['program', 'zakat', 'wakaf', 'dana_abadi']);
            
            // Pakai bigInteger sesuai requestmu (angka bulat)
            $table->bigInteger('amount'); 
            
            $table->string('order_id')->unique();
            $table->string('payment_type')->nullable(); // qris, bank_transfer, gopay
            
            // Status default pending
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');
            
            // Data respon dari Midtrans (disimpan sebagai JSON biar fleksibel)
            $table->json('provider_response')->nullable();
            
            // Link gambar bukti bayar (opsional kalau manual)
            $table->string('receipt_url')->nullable();

            // Nomor Akte (String, Unik, Nullable karena Pending belum punya nomor)
            $table->string('nomor_akte')->nullable()->unique();
            
            // Tanggal Akte (Disimpan terpisah dari created_at biar presisi kapan sah-nya)
            $table->date('tgl_akte')->nullable();

            // Gabungan dari file migration ke-3 tadi
            $table->string('certificate_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};