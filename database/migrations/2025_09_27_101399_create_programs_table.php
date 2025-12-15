<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            
            // Slug buat URL cantik
            $table->string('slug')->unique(); 

            $table->text('description');
            
            // Kategori (Wakaf Uang / Project / Zakat)
            $table->string('category')->nullable();
            
            $table->string('image')->nullable();
            
            // Pakai bigInteger (Angka Bulat)
            // Nullable tetap wajib biar Wakaf Abadi (ID 1) gak error
            $table->bigInteger('target_amount')->nullable(); 
            
            // Default 0 buat uang terkumpul
            $table->bigInteger('collected_amount')->default(0);
            
            $table->boolean('is_active')->default(true);
            $table->boolean('is_unggulan')->default(false);
            
            // Deadline nullable
            $table->date('deadline')->nullable();
            
            $table->string('certificate_type')->default('none');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};