<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Document;
use Illuminate\Http\Request;

class PanitiaController extends Controller
{

    public function dashboard()
    {
        $todayRegistrations = \App\Models\Registration::whereDate('created_at', today())->count();

        $menungguVerifikasi = \App\Models\Registration::where('status', 'menunggu_verifikasi')->count();

        $terverifikasi = \App\Models\Registration::where('status', 'terverifikasi')->count();

        $dokumenDitolak = \App\Models\Document::where('status_verifikasi', 'ditolak')->count();

        return view('panitia.dashboard', compact(
            'todayRegistrations',
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
    public function reject(Request $request, $id)
    {
        $doc = Document::findOrFail($id);

        $doc->update([
            'status_verifikasi' => 'ditolak',
            'catatan' => $request->catatan
        ]);

        $doc->registration->update([
            'status' => 'menunggu_upload'
        ]);

        return back();
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