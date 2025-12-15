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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            // --- DATA PRIBADI ---
            $table->string('nama');
            $table->string('nik')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('nomor_hp')->nullable();
            $table->string('avatar')->nullable(); // Gabungan dari file avatar
            
            // --- OTENTIKASI & KEAMANAN ---
            $table->enum('role', ['admin', 'donatur'])->default('donatur');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // Gabungan dari file verification code (biasanya buat OTP / Reset Password)
            $table->string('verification_code')->nullable();
            $table->timestamp('verification_code_expires_at')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};