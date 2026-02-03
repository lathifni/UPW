<?php

namespace App\Exports;

use App\Models\Donation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// class DonationFilterExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         //
//     }
// }
class DonationFilterExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $bulan;
    protected $tahun;
    protected $programId;
    protected $kategori;

    // 1. Terima parameter dari Controller lewat Constructor
    public function __construct($bulan, $tahun, $programId, $kategori)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->programId = $programId;
        $this->kategori = $kategori;
    }

    // 2. Query data sesuai filter
    public function query()
    {
        $query = Donation::query()->with('program'); // Eager load relasi jika perlu

        if ($this->bulan) {
            $query->whereMonth('created_at', $this->bulan);
        }

        if ($this->tahun) {
            $query->whereYear('created_at', $this->tahun);
        }

        if ($this->programId) {
            $query->where('program_id', $this->programId);
        }

        if ($this->kategori) {
            $query->where('donor_category', $this->kategori);
        }

        // Urutkan biar rapi, misal dari yang terbaru
        return $query->orderBy('created_at', 'desc');
    }

    // 3. Mapping data (kolom apa aja yang mau masuk Excel)
    public function map($donation): array
    {
        return [
            $donation->created_at->format('d-m-Y'),
            $donation->donor_name,
            $donation->program->title ?? '-', // Ambil nama program dari relasi
            $donation->donor_category,
            "Rp " . number_format($donation->amount, 0, ',', '.'),
            $donation->status,
        ];
    }

    // 4. Judul Header di Excel
    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Donatur',
            'Program',
            'Kategori',
            'Nominal',
            'Status',
        ];
    }
}
