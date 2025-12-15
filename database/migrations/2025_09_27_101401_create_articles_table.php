<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            
            // Slug & Category (Gabungan dari file migrasi susulan)
            $table->string('slug')->unique(); // Wajib unik buat URL
            $table->string('category')->nullable();
            
            $table->text('content');
            $table->string('image')->nullable();
            
            // Views (Default 0)
            $table->unsignedBigInteger('views')->default(0);

            // RELASI USER (Penulis)
            // 'constrained' otomatis nyari id di tabel 'users'
            // 'cascadeOnDelete' artinya kalau user dihapus, artikelnya ikut kehapus (opsional, bisa ganti nullOnDelete)
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->comment('Author');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};