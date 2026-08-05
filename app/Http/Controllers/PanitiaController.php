<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Document;
use Illuminate\Http\Request;

class PanitiaController extends Controller
{

    public function dashboard()
{
    $totalPendaftar = Registration::count();

    $menungguUpload = Registration::where(
        'status',
        'menunggu_upload'
    )->count();

    $menungguVerifikasi = Registration::where(
        'status',
        'menunggu_verifikasi'
    )->count();

    $terverifikasi = Registration::where(
        'status',
        'terverifikasi'
    )->count();

    $dokumenDitolak = Document::where(
        'status_verifikasi',
        'ditolak'
    )->count();

    return view('panitia.dashboard', compact(
        'totalPendaftar',
        'menungguUpload',
        'menungguVerifikasi',
        'terverifikasi',
        'dokumenDitolak'
    ));
}
    // LIST SISWA
    public function index()
    {
        $registrations = Registration::with('student')
            ->latest()
            ->get();

        return view('panitia.index', compact('registrations'));
    }

    // DETAIL SISWA + DOKUMEN
    public function show($id)
    {
        $registration = Registration::with(['student', 'documents'])
            ->findOrFail($id);

        return view('panitia.show', compact('registration'));
    }

    // APPROVE DOKUMEN
    public function approve($id)
    {
        $doc = Document::findOrFail($id);

        $doc->update([
            'status_verifikasi' => 'disetujui',
            'catatan' => null
        ]);

        $this->updateStatusRegistration($doc->registration_id);

        return back();
    }

    // REJECT DOKUMEN
    // public function reject(Request $request, $id)
    // {
    //     $doc = Document::findOrFail($id);

    //     $doc->update([
    //         'status_verifikasi' => 'ditolak',
    //         'catatan' => $request->catatan
    //     ]);

    //     $doc->registration->update([
    //         'status' => 'menunggu_upload'
    //     ]);

    //     return back();
    // }
    public function reject(Request $request, $id)
{
    $request->validate([
        'catatan' => 'required|string|min:5|max:255',
    ], [
        'catatan.required' => 'Catatan penolakan wajib diisi.',
        'catatan.min' => 'Catatan minimal 5 karakter.',
        'catatan.max' => 'Catatan maksimal 255 karakter.',
    ]);

    $doc = Document::findOrFail($id);

    $doc->update([
        'status_verifikasi' => 'ditolak',
        'catatan' => $request->catatan,
    ]);

    $doc->registration->update([
        'status' => 'menunggu_upload',
    ]);

    return back()->with('success', 'Dokumen berhasil ditolak.');
}

    // CEK SEMUA DOKUMEN
    private function updateStatusRegistration($registrationId)
    {
        $registration = Registration::with('documents')->find($registrationId);

        $allApproved = $registration->documents()
            ->where('status_verifikasi', '!=', 'disetujui')
            ->count() === 0;

        if ($allApproved) {
            $registration->update([
                'status' => 'terverifikasi'
            ]);
        }
    }
}