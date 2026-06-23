<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JalurPendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jalur_pendaftaran')->insert([
            [
                'nama' => 'Reguler',
                'kuota' => 20,
                'deskripsi' => 'Seleksi berdasarkan nilai rapor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Prestasi',
                'kuota' => 8,
                'deskripsi' => 'Wajib sertifikat prestasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Zonasi',
                'kuota' => 5,
                'deskripsi' => 'Domisili sesuai kecamatan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}