<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('management', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('position'); // Cth: Rektor / Penanggung Jawab
            
            // Tambahan dari file susulan (Nullable)
            $table->string('role')->nullable(); 
            
            $table->enum('level', ['penanggung-jawab', 'dewan-pengawas', 'anggota-upw']);
            
            $table->string('image')->nullable();
            
            // Tambahan dari file susulan (Nullable)
            $table->text('description')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('management');
    }
};