<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SelectionExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Registration::with(['student', 'jalur'])
            ->where('status', 'diterima')
            ->get()
            ->map(function ($reg) {
                return [
                    $reg->nomor_pendaftaran,
                    $reg->student->nama_lengkap,
                    $reg->student->nik,
                    $reg->student->nilai_rata_rata,
                    $reg->jalur->nama,
                    $reg->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'Nama Siswa',
            'NIK',
            'Nilai Rata-rata',
            'Jalur Pendaftaran',
            'Status Kelulusan',
        ];
    }
}