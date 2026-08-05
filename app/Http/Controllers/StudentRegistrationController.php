<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Registration;
use App\Models\JalurPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'nik' => [
                'required',
                'digits:16',
                Rule::unique('students', 'nik'),
            ],
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ortu' => 'required|string|max:255',
            'jalur_id' => 'required|exists:jalur_pendaftaran,id',
            'sekolah_asal' => 'required|string|max:255',
            'nilai_rata_rata' => 'required|numeric|min:0|max:100',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
        ]);

        // Cek apakah user sudah pernah mendaftar
        $student = Student::where('user_id', Auth::id())->first();

        if ($student && Registration::where('student_id', $student->id)->exists()) {
            return redirect()
                ->route('student.dashboard')
                ->with('error', 'Anda sudah melakukan pendaftaran.');
        }

        DB::transaction(function () use ($request) {

            // Simpan data siswa
            $student = Student::create([
                'user_id' => Auth::id(),
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'kecamatan' => $request->kecamatan,
                'no_hp' => $request->no_hp,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ortu' => $request->pekerjaan_ortu,
                'sekolah_asal' => $request->sekolah_asal,
                'nilai_rata_rata' => $request->nilai_rata_rata,
            ]);

            // Generate nomor pendaftaran
            $lastId = (Registration::max('id') ?? 0) + 1;

            $nomor = 'PPDB-2026-' . str_pad($lastId, 5, '0', STR_PAD_LEFT);

            // Simpan data pendaftaran
            Registration::create([
                'student_id' => $student->id,
                'jalur_id' => $request->jalur_id,
                'nomor_pendaftaran' => $nomor,
                'status' => 'menunggu_upload',
            ]);
        });

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Pendaftaran berhasil.');
    }
}