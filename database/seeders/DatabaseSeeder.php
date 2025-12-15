<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- Import model User
use Illuminate\Support\Facades\Hash; // <-- Import Hash facade

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat user admin
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@unand.ac.id',
            'nik' => '0000000000000000', // NIK dummy untuk admin
            'nomor_hp' => '+6281234567890',    // No HP dummy untuk admin
            'password' => Hash::make('password'), // Password default: 'password'
            'role' => 'admin',
        ]);

        // 2. Membuat user donatur untuk testing
        User::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@email.com',
            'nik' => '1234567890123456', // NIK dummy untuk donatur
            'nomor_hp' => '+6289876543210',    // No HP dummy untuk donatur
            'password' => Hash::make('password'), // Password default: 'password'
            'role' => 'donatur', // Role sebagai donatur
        ]);

        // 3. Memanggil seeder lainnya
        $this->call([
            ManagementSeeder::class,
            WakafUangSeeder::class,
        ]);
    }
}
