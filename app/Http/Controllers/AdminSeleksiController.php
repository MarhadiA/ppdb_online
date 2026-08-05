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
                ->filter(function ($registration) {

                    return $registration->student !== null;

                });


            /*
            |--------------------------------------------------------------------------
            | FILTER ZONASI
            |--------------------------------------------------------------------------
            */

            if (str_contains(
                strtolower($jalur->nama),
                'zonasi'
            )) {


                $kecamatanSekolah = config(
                    'ppdb.kecamatan_sekolah'
                );


                $registrations = $registrations
                    ->filter(function ($registration) use ($kecamatanSekolah) {


                        return strtolower(
                            $registration->student->kecamatan
                        ) == strtolower($kecamatanSekolah);


                    });

            }


            /*
            |--------------------------------------------------------------------------
            | SORT NILAI
            |--------------------------------------------------------------------------
            */

            $registrations = $registrations
                ->sortByDesc(function ($registration) {


                    return $registration
                        ->student
                        ->nilai_rata_rata;


                })
                ->values();



            /*
            |--------------------------------------------------------------------------
            | SIMPAN HASIL SELEKSI
            |--------------------------------------------------------------------------
            */

            foreach ($registrations as $index => $registration) {


                $ranking = $index + 1;


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
            ->with(
                'success',
                'Seleksi berhasil dijalankan'
            );
    }



    // =========================
    // PREVIEW HASIL
    // =========================
    public function preview()
    {

        $data = Registration::with(['student','jalur'])

            ->whereIn(
                'status',
                [
                    'diterima',
                    'tidak_diterima',
                    'terverifikasi'
                ]
            )

            ->orderBy('jalur_id')

            ->orderBy('ranking_nilai')

            ->get();


        return view(
            'admin.seleksi.preview',
            compact('data')
        );
    }
}