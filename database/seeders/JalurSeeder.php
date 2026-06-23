<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JalurPendaftaran;


class JalurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          JalurPendaftaran::create([
        'nama' => 'Reguler',
        'kuota' => 20,
        'deskripsi' => 'Seleksi berdasarkan nilai rapor'
    ]);

    JalurPendaftaran::create([
        'nama' => 'Prestasi',
        'kuota' => 8,
        'deskripsi' => 'Wajib upload piagam + nilai tinggi'
    ]);

    JalurPendaftaran::create([
        'nama' => 'Zonasi',
        'kuota' => 5,
        'deskripsi' => 'Berdasarkan domisili'
    ]);
    }
}
