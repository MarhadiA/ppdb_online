<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CloudinaryService;

class StudentDocumentController extends Controller
{
    public function index()
    {
        $student = Student::with('registration')
            ->where('user_id', Auth::id())
            ->first();

        return view('student.documents.index', compact('student'));
    }

    public function store(Request $request,CloudinaryService $cloudinaryService)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kk' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
            'ijazah' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
            'rapor' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $student = Student::with('registration')
            ->where('user_id', Auth::id())
            ->first();

        $registration = $student->registration;

        $docs = [
            'foto' => $request->file('foto'),
            'kk' => $request->file('kk'),
            'ijazah' => $request->file('ijazah'),
            'rapor' => $request->file('rapor'),
        ];

        foreach ($docs as $jenis => $file) {

    $upload = $cloudinaryService->upload($file->getRealPath());

    Document::create([
        'registration_id' => $registration->id,
        'jenis_dokumen' => $jenis,
        'cloudinary_url' => $upload['secure_url'],
        'cloudinary_public_id' => $upload['public_id'],
        'status_verifikasi' => 'menunggu_verifikasi',
        'catatan' => null,
    ]);
}
   
        
      

        $registration->update([
            'status' => 'menunggu_verifikasi'
        ]);

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Dokumen berhasil diupload');
    }
}