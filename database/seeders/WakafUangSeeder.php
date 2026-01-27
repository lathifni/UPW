<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class WakafUangSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Program Beasiswa (ID 1)
        Program::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Wakaf Uang Program Beasiswa',
                'slug' => 'wakaf-uang-beasiswa', // Saya update slug-nya biar lebih spesifik
                'category' => 'Wakaf Uang', 
                'description' => 'Program Wakaf Uang (Dana Abadi) yang dikelola secara produktif untuk kemaslahatan umat. Hasil pengelolaannya akan disalurkan untuk beasiswa mahasiswa berprestasi namun kurang mampu.',
                'image' => 'wakaf-uang-default.jpg', 
                'target_amount' => null, 
                'deadline' => null,
                'collected_amount' => 0, 
                'is_active' => true,
                'is_unggulan' => true,
                'certificate_type' => 'gold',
                'rekening_id' => 1
            ]
        );

        // 2. Program RS UNAND (ID 2) - INI TAMBAHANNYA BRO
        Program::updateOrCreate(
            ['id' => 2], // Kita paksa ID 2
            [
                'title' => 'Wakaf Uang Layanan RS UNAND',
                'slug' => 'wakaf-uang-rs-unand', // Slug harus unik
                
                // Pastikan kategorinya SAMA PERSIS (Spasi)
                'category' => 'Wakaf Uang', 
                
                'description' => 'Wakaf produktif untuk peningkatan fasilitas kesehatan dan pengadaan alat medis canggih di Rumah Sakit Universitas Andalas. Manfaat wakaf akan dialirkan untuk subsidi layanan kesehatan bagi pasien dhuafa dan peningkatan mutu RS.',
                
                // Jangan lupa siapin gambar 'rs-unand.jpg' di storage nanti
                'image' => 'rs-unand.jpg', 
                
                // Dana abadi biasanya tidak ada target (unlimited)
                'target_amount' => null, 
                'deadline' => null,
                
                'collected_amount' => 0, 
                
                'is_active' => true,
                // Kita coba set unggulan jadi TRUE, biar muncul di slider paling atas
                'is_unggulan' => false, 
                'certificate_type' => 'gold',
                'rekening_id' => 1
            ]
        );

         Program::updateOrCreate(
            ['id' => 3], // Kita paksa ID 3
            [
                'title' => 'Penyertaan Modal Coffeenary Mangunsarkoro',
                'slug' => 'Penyertaan-Modal-Coffeenary-Mangunsarkoro', // Slug harus unik
                
                // Pastikan kategorinya SAMA PERSIS (Spasi)
                'category' => 'Wakaf Melalui Uang', 
                
                'description' => 'Unit Wakaf UNAND menghadirkan inovasi kebaikan melalui program Wakaf Melalui Uang Produktif. Kami mengajak Anda untuk turut serta dalam pembiayaan modal usaha Coffeenary Mangunsarkoro, sebuah unit bisnis kuliner potensial yang dikelola secara profesional di Kota Padang.

Bagaimana Skema Wakaf Ini Berjalan?

Dana wakaf yang Anda salurkan akan dikumpulkan secara kolektif hingga mencapai target yang ditentukan. Dana tersebut akan dijadikan Penyertaan Modal untuk pengembangan bisnis Coffeenary di Jl. Mangunsarkoro. Pokok wakaf Anda tetap utuh sebagai aset modal, sementara keuntungan usaha (dividen) yang diperoleh setiap periodenya akan disalurkan 100% untuk Program Beasiswa Mahasiswa UNAND.

Dengan berwakaf di program ini, Anda tidak hanya membantu memajukan ekonomi umat, tetapi juga menjadi orang tua asuh bagi mahasiswa yang membutuhkan biaya pendidikan. Pahala mengalir dari setiap cangkir kopi yang terjual, menjadi ilmu yang bermanfaat bagi para penerima beasiswa..',
                
                // Jangan lupa siapin gambar 'rs-unand.jpg' di storage nanti
                'image' => 'image.png', 
                
                // Dana abadi biasanya tidak ada target (unlimited)
                'target_amount' => 350000000, 
                'deadline' => null,
                
                'collected_amount' => 0, 
                
                'is_active' => true,
                // Kita coba set unggulan jadi TRUE, biar muncul di slider paling atas
                'is_unggulan' => false, 
                'certificate_type' => 'gold',
                'rekening_id' => 2
            ]
        );
    }
}