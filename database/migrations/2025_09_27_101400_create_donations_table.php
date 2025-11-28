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
            // HANYA DEFINISIKAN KOLOM, HAPUS RELASI
            $table->foreignId('user_id')->nullable();
            $table->foreignId('program_id')->nullable();
            $table->enum('donation_type', ['program', 'zakat', 'wakaf', 'dana_abadi']);
            $table->bigInteger('amount');
            $table->string('order_id')->unique();
            $table->string('payment_type')->nullable();
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');
            $table->json('provider_response')->nullable();
            $table->string('receipt_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
