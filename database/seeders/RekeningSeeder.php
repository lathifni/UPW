<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekeningSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rekenings')->insert([
            [
                'nama_bank' => 'Bank Syariah Indonesia (BSI)',
                'nomor_rekening' => '7771234567',
                'atas_nama' => 'UP WAKAF UNAND',
                'logo' => 'bsi.png',
                'qris_image' => 'up-wakaf-unand.jpeg', // <--- Pastikan file ini ada di folder public
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_bank' => 'Bank Nagari Syariah',
                'nomor_rekening' => '21000101010101',
                'atas_nama' => 'WAKAF UNAND',
                'logo' => 'wakaf-unand(bank-nagari).jpeg',
                'qris_image' => null, // Contoh kalau bank ini gak ada QRIS
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}