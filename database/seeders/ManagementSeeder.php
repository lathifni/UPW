<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Management;

class ManagementSeeder extends Seeder
{
    public function run(): void
    {
        Management::insert([
            // Penanggung Jawab
            [
                'name' => 'Dr. Efa Yonnedi, SE. MPPM, Akt',
                'position' => 'Rektor',
                'role' => 'Penanggung Jawab', // <-- Data baru
                'level' => 'penanggung-jawab',
                'image' => null,
                'description' => null, // <-- Data baru
            ],
            // Dewan Pengawas
            [
                'name' => 'Dr. Hefrizal Handra, M.Soc.Sc',
                'position' => 'Wakil Rektor II',
                'role' => 'Dewan Pengawas', // <-- Data baru
                'level' => 'dewan-pengawas',
                'image' => null,
                'description' => null,
            ],
            [
                'name' => 'Dr. Suhanda, SE., M.Si., Ak, CA',
                'position' => 'Direktur Keuangan',
                'role' => 'Dewan Pengawas', // <-- Data baru
                'level' => 'dewan-pengawas',
                'image' => null,
                'description' => null,
            ],
            // Anggota UPW
            [
                'name' => 'Dr. Zulkifli N, SE., M.Si',
                'position' => 'Ketua',
                'role' => null, // <-- Data baru
                'level' => 'anggota-upw',
                'image' => null,
                'description' => null, // <-- Data baru
            ],
            [
                'name' => 'Adila Adisti,SE,M.Ec',
                'position' => 'Sekretaris / Bendahara',
                'role' => null, // <-- Data baru
                'level' => 'anggota-upw',
                'image' => null,
                'description' => null, // <-- Data baru
            ],
            [
                'name' => 'Baitul Hamdi,S.E.,M.SEI',
                'position' => 'Koordinator Pengumpulan Wakaf',
                'role' => null, // <-- Data baru
                'level' => 'anggota-upw',
                'image' => null,
                'description' => null, // <-- Data baru
            ],
            [
                'name' => 'Dr. Roni Ekha Putera, S.IP., MPA',
                'position' => 'Koordinator Pengelolaan Wakaf',
                'role' => null, // <-- Data baru
                'level' => 'anggota-upw',
                'image' => null,
                'description' => null, // <-- Data baru
            ],
            [
                'name' => 'Dr. dr. Muhammad Reindra, Sp.BTKV',
                'position' => 'Koordinator Pendistribusian Manfaat Wakaf',
                'role' => null, // <-- Data baru
                'level' => 'anggota-upw',
                'image' => null,
                'description' => null, // <-- Data baru
            ],
        ]);
    }
}
