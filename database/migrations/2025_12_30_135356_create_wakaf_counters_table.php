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
        Schema::create('wakaf_counters', function (Blueprint $table) {
            $table->id(); // Primary Key (Tetap ada, biarpun jarang dipanggil)

            // Kolom Tahun (2025, 2026, dst)
            $table->integer('year'); 

            // Angka Terakhir. Wajib default 0 biar start dari 0.
            // Pakai unsignedBigInteger biar muat banyak, jaga-jaga kalau donatur meledak.
            $table->unsignedBigInteger('last_number')->default(0); 

            $table->timestamps();

            // 🔥 INI BAGIAN PALING PENTING (CONSTRAINT) 🔥
            // Kombinasi 'year' dan 'type' harus unik.
            // Database akan menolak kalau ada baris ganda (misal: dua baris untuk "2025 - uang").
            // Ini yang bikin logic firstOrCreate tadi aman sentosa.
            $table->unique(['year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wakaf_counters');
    }
};