<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_transactions', function (Blueprint $table) {
            $table->id();
            // HANYA DEFINISIKAN KOLOM, HAPUS RELASI
            $table->foreignId('fund_id');
            $table->foreignId('donation_id')->nullable();
            $table->enum('type', ['credit', 'debit']);
            $table->bigInteger('amount');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_transactions');
    }
};
