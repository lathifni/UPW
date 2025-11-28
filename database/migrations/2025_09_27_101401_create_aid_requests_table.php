<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aid_requests', function (Blueprint $table) {
            $table->id();
            // HANYA DEFINISIKAN KOLOM, HAPUS RELASI
            $table->foreignId('user_id');
            $table->string('title');
            $table->text('details');
            $table->enum('status', ['pending', 'verified', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aid_requests');
    }
};
