<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class WakafUangSeeder extends Seeder
{
    public function run(): void
    {
        // Kita Paksa ID = 1 sebagai Master Data
        Program::updateOrCreate(
            ['id' => 1], // Kunci pencarian
            [
                'title' => 'Wakaf Uang',
                'slug' => 'wakaf-uang', // Slug cantik
                
                // Ini kategori PENTING buat logic controller tadi
                'category' => 'wakaf_uang', 
                
                'description' => 'Program Wakaf Uang (Dana Abadi) yang dikelola secara produktif untuk kemaslahatan umat. Pokok wakaf tidak akan berkurang, dan hasil pengelolaannya akan disalurkan untuk beasiswa dan bantuan sosial.',
                
                // Gambar default (pastikan file ini ada atau null dulu gpp)
                'image' => 'wakaf-uang-default.jpg', 
                
                // FITUR KUNCI: Target & Deadline NULL
                'target_amount' => null, 
                'deadline' => null,
                
                // Uang terkumpul awal (bisa 0 atau angka dummy buat tes grafik)
                'collected_amount' => 0, 
                
                'is_active' => true,
                'is_unggulan' => false,
                'certificate_type' => 'gold' // Sertifikat spesial
            ]
        );
    }
}