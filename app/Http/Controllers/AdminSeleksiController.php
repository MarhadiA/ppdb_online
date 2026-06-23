<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\JalurPendaftaran;

class AdminSeleksiController extends Controller
{
    // =========================
    // LIST VERIFIKASI
    // =========================
    public function index()
    {
        $data = Registration::with(['student', 'jalur'])
            ->where('status', 'terverifikasi')
            ->get();

        return view('admin.seleksi.index', compact('data'));
    }

    // =========================
    // RUN SELEKSI
    // =========================
    public function run()
    {
        $jalurs = JalurPendaftaran::all();

        foreach ($jalurs as $jalur) {

            $registrations = Registration::with('student')
                ->where('jalur_id', $jalur->id)
                ->where('status', 'terverifikasi')
                ->where('is_final', false)
                ->get()
                ->filter(fn($r) => $r->student)
                ->sortByDesc(fn($r) => $r->student->nilai_rata_rata)
                ->values();
            //  amanin kalau student null
            $registrations = $registrations->filter(function ($r) {
                return $r->student !== null;
            });

            //  sorting nilai tertinggi
            $registrations = $registrations
                ->sortByDesc(fn($r) => $r->student->nilai_rata_rata)
                ->values();

            foreach ($registrations as $index => $registration) {

                $ranking = $index + 1;

                //  logic kuota
                $status = $ranking <= $jalur->kuota
                    ? 'diterima'
                    : 'tidak_diterima';

                $registration->update([
                    'ranking_nilai' => $ranking,
                    'status' => $status,
                ]);
            }
        }

        return redirect('/admin/seleksi')
            ->with('success', 'Seleksi berhasil dijalankan');
    }
    public function preview()
{
    $data = Registration::with(['student','jalur'])
        ->whereIn('status', ['diterima','tidak_diterima','terverifikasi'])
        ->orderBy('jalur_id')
        ->orderByDesc('ranking_nilai')
        ->get();

    return view('admin.seleksi.preview', compact('data'));
}
}