<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekenings', function (Blueprint $table) {
            $table->id();
            
            // Nama Bank (Cth: Bank Syariah Indonesia, Bank Nagari)
            $table->string('nama_bank');
            
            // Nomor Rekening (Pakai STRING biar angka 0 di depan gak hilang)
            $table->string('nomor_rekening');
            
            // Atas Nama (Cth: RPL 010 BLU UNAND)
            $table->string('atas_nama');
            
            // Logo Bank (Optional, buat nampilin icon bank)
            $table->string('logo')->nullable();
            $table->string('qris_image')->nullable();
            
            // Status Aktif (Biar bisa disembunyikan tanpa dihapus)
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekenings');
    }
};
