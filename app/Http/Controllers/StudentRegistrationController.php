<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JalurPendaftaran;

class StudentRegistrationController extends Controller
{
    public function create()
    {
          $jalurs = JalurPendaftaran::all();

    return view('student.registration.create', compact('jalurs'));
    }

    public function store(Request $request)
    {
       $request->validate([
            'nik' => 'required',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ortu' => 'required',
            'jalur_id' => 'required|exists:jalur_pendaftaran,id',
            'sekolah_asal' => 'required',
            'nilai_rata_rata' => 'required|numeric|min:0|max:100',
        ]);

        // =========================
        // SIMPAN DATA STUDENT
        // =========================
        $student = Student::create([
            'user_id' => Auth::id(),
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ortu' => $request->pekerjaan_ortu,
            'sekolah_asal' => $request->sekolah_asal,
            'nilai_rata_rata' => $request->nilai_rata_rata,
        ]);

        // =========================
        // GENERATE NOMOR
        // =========================
        $lastId = Registration::count() + 1;

        $nomor = 'PPDB-2026-' . str_pad($lastId, 5, '0', STR_PAD_LEFT);

        // =========================
        // SIMPAN REGISTRATION
        // =========================
        Registration::create([
            'student_id' => $student->id,
            'jalur_id' => $request->jalur_id,
            'nomor_pendaftaran' => $nomor,
            'status' => 'menunggu_upload'
        ]);

        return redirect('/student/dashboard')
            ->with('success', 'Pendaftaran berhasil');
    }
}